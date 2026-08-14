<script>
    let FASTQ_DOWNLOAD_STATUS = false;
    let pollTimer = null;

    $(document).on('change', '#download-tbl #FASTQ_all', function () {
        const checked = $(this).is(':checked');
        const target = $('#download-tbl').find('.FASTQ-chk');

        target.prop('checked', checked);
    });

    $(document).on('change', '#download-tbl .FASTQ-chk', function () {
        const allLength = $('#download-tbl').find('.FASTQ-chk').length;
        const checkedLength = $('#download-tbl').find('.FASTQ-chk:checked').length;
        const target = $('#download-tbl').find('#FASTQ_all');

        target.prop('checked', (allLength === checkedLength));
    });

    $(document).on('click', '.FASTQ-cancel-download', function () {
        if (!FASTQ_DOWNLOAD_STATUS) return;

        clearInterval(pollTimer);
        FASTQ_DOWNLOAD_STATUS = false;

        $('.bg-box.type-info').hide();
        console.log('download cancel');
        // 필요하면 서버에 job 취소 요청도 별도로 보내기
    });

    $(document).on('click', '.FASTQ-choice-download', function (e) {
        e.preventDefault();

        const download_link = $(this).attr('href');
        let FILE_KEY = [];

        $('#download-tbl').find('.FASTQ-chk:checked').each(function() {
            FILE_KEY.push($(this).val());
        });

        if (FILE_KEY.length === 0) {
            alert('선택된 항목이 없습니다.');
            return;
        }

        const download_info = {
            'link': download_link,
            'type': 'choice',
            'FILE_KEY': FILE_KEY,
        }

        startDownloadFASTQ(download_info);
    });

    $(document).on('click', '.FASTQ-all-download', function (e) {
        e.preventDefault();

        const download_link = $(this).attr('href');

        if ($('#download-tbl').find('.FASTQ-chk').length === 0) {
            alert('다운로드 가능한 항목이 없습니다.');
            return;
        }

        const download_info = {
            'link': download_link,
            'type': 'all',
            'FILE_KEY': [],
        }

        startDownloadFASTQ(download_info);
    });

    const startDownloadFASTQ = (download_info) => {

        if (FASTQ_DOWNLOAD_STATUS) {
            alert('다운로드가 진행중입니다.');
            return false;
        }

        let downloadData = new FormData();
        downloadData.append('spinner_text', '압축 파일을 생성하는 중입니다...');
        downloadData.append('download_type', download_info['type']);

        download_info['FILE_KEY'].forEach(function(key, index) {
            downloadData.append('FILE_KEY[]', key);
        });

        callbackMultiAjax(download_info['link'], downloadData, function (data, error) {
            if (error) {
                ajaxErrorData(error);
                return false;
            }

            ajaxSuccessData(data);

            if (!isEmpty(data['file_data'])) {
                zipDownloadProgress(data['file_data']);
            }
        });
    }

    // 다운로드 시작 및 Progress 표기
    async function zipDownloadProgress(fileData) {
        let download_url = '{{ route('FASTQDownload', ['job_id' => '__JOB_ID__']) }}';
        download_url = download_url.replace('__JOB_ID__', fileData['job_id']);

        FASTQ_DOWNLOAD_STATUS = true;
        $('#download-tbl').find('input[type=checkbox]').attr('onclick', 'return false;');

        if (window.showSaveFilePicker) {
            await downloadStreaming(download_url, fileData); // Chrome/Edge - 스트리밍
        } else {
            downloadBlob(download_url, fileData); // Safari/Firefox - Blob
        }
    }

    // Chrome/Edge: 디스크에 바로 흘려쓰기 (대용량 안전)
    async function downloadStreaming(download_url, fileData) {
        try {
            const fileHandle = await window.showSaveFilePicker({ suggestedName: fileData['file_name'] });
            const writable = await fileHandle.createWritable();

            const response = await fetch(download_url);

            // fetch는 403/404 등 HTTP 에러여도 reject 안 됨 -> 직접 체크 필요
            if (!response.ok) {
                await writable.close();
                const err = await response.json().catch(() => null);
                onDownloadFailed(err?.message || `서버 오류가 발생했습니다. (${response.status})`);
                return;
            }

            const total = parseInt(response.headers.get('Content-Length'), 10);
            let loaded = 0;

            const reader = response.body.getReader();
            const startTime = Date.now();

            while (true) {
                const { done, value } = await reader.read();
                if (done) break;

                await writable.write(value);
                loaded += value.length;

                updateProgressUI(fileData, loaded, total, startTime);
            }

            await writable.close();
            onDownloadComplete();
        } catch (err) {
            if (err.name === 'AbortError') {
                // 저장 다이얼로그 취소 또는 controller.abort() 호출로 인한 중단
                onDownloadCancelled();
            } else if (err.name === 'NotAllowedError') {
                onDownloadFailed('다운로드 권한이 거부되었습니다. 버튼을 다시 눌러주세요.');
            } else if (err instanceof TypeError) {
                onDownloadFailed('네트워크 연결이 끊어졌습니다.');
            } else {
                console.error(err);
                onDownloadFailed('다운로드 중 오류가 발생했습니다.');
            }
        }
    }

    // Safari/Firefox: Blob 방식 폴백
    function downloadBlob(download_url, fileData) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', download_url, true);
        xhr.responseType = 'blob';

        const startTime = Date.now();

        xhr.onprogress = function (e) {
            if (!e.lengthComputable) return;
            updateProgressUI(fileData, e.loaded, e.total, startTime);
        };

        xhr.onload = function () {
            if (xhr.status !== 200) {
                // 에러 응답은 JSON(blob)으로 오므로 텍스트로 변환해서 파싱
                const reader = new FileReader();

                reader.onload = function () {
                    try {
                        const err = JSON.parse(reader.result);
                        onDownloadFailed(err?.message || `서버 오류가 발생했습니다. (${xhr.status})`);
                    } catch (e) {
                        onDownloadFailed(`서버 오류가 발생했습니다. - 1 (${xhr.status})`);
                    }
                };

                reader.onerror = function () {
                    onDownloadFailed(`서버 오류가 발생했습니다. - 2 (${xhr.status})`);
                };

                reader.readAsText(xhr.response);
                return;
            }

            const blobUrl = URL.createObjectURL(xhr.response);
            const a = document.createElement('a');

            a.href = blobUrl;
            a.download = fileData['file_name'];
            document.body.appendChild(a);
            a.click();
            a.remove();

            URL.revokeObjectURL(blobUrl);
            onDownloadComplete();
        };

        xhr.onerror = function () {
            console.error('XHR error', {
                status: xhr.status,
                statusText: xhr.statusText,
                readyState: xhr.readyState,
                responseURL: xhr.responseURL
            });

            const message = xhr.status === 0
                ? '네트워크 연결이 끊어졌습니다.'
                : `다운로드 중 오류가 발생했습니다. (${xhr.status})`;

            onDownloadFailed(message);
        };

        xhr.onabort = function () {
            // 브라우저 자체 중지 버튼, 또는 코드에서 xhr.abort() 호출 시 발생
            onDownloadCancelled();
        };
        
        xhr.ontimeout = function () {
            onDownloadFailed('다운로드 시간이 초과되었습니다.');
        };

        xhr.send();
    }

    // progress bar + 용량/속도 텍스트 갱신
    function updateProgressUI(fileData, loaded, total, startTime) {
        const percent = Math.round((loaded / total) * 100);
        const elapsedSec = (Date.now() - startTime) / 1000;
        const speed = loaded / elapsedSec;

        if (fileData['download_type'] === 'all') {
            $('.download-progress-bar progress').val(percent);
            $('.download-progress-bar .value').attr('data-value', percent);
            $('.progress-wrap .download-volume').text(`${formatBytesJS(loaded)} (${formatBytesJS(speed)}/초)`);
        } else {
            // <strong class="text-blue">완료</strong>
            // 대기
        }
    }

    function onDownloadCommonAction() {
        $('#download-tbl').find('input[type=checkbox]').removeAttr('onclick');
        FASTQ_DOWNLOAD_STATUS = false;
    }

    function onDownloadCancelled() {
        onDownloadCommonAction();
        alert('다운로드가 취소되었습니다.');
    }

    function onDownloadComplete() {
        onDownloadCommonAction();
        alert('다운로드가 완료되었습니다.');
    }

    function onDownloadFailed(message) {
        console.log(message);
        onDownloadCommonAction();
        alert(message);
        // location.reload();
    }

    function formatBytesJS(bytes) {
        if (bytes >= 1024 * 1024) return (bytes / 1024 / 1024).toFixed(1) + 'MB';
        if (bytes >= 1024) return (bytes / 1024).toFixed(1) + 'KB';
        return Math.round(bytes) + 'B';
    }

    function formatTime(sec) {
        const m = Math.floor(sec / 60);
        const s = sec % 60;
        return m > 0 ? `${m}분 ${s}초` : `${s}초`;
    }
</script>