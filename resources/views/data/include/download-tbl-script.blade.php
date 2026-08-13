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

    $(document).on('click', '.FASTQ-choice-download', function (e) {
        e.preventDefault();

        let download_link = $(this).attr('href');
        const checked_values = [];

        $('#download-tbl').find('.FASTQ-chk:checked').each(function() {
            checked_values.push($(this).val());
        });

        if (checked_values.length === 0) {
            alert('선택된 항목이 없습니다.');
            return;
        }

        const separator = download_link.includes('?') ? '&' : '?';

        const query = checked_values
            .map(v => `FILE_KEY[]=${encodeURIComponent(v)}`)
            .join('&');

        download_link = (download_link + separator + query);
        startDownloadFASTQ(download_link, 'choice');
    });

    $(document).on('click', '.FASTQ-all-download', function (e) {
        e.preventDefault();

        if ($('#download-tbl').find('.FASTQ-chk').length === 0) {
            alert('다운로드 가능한 항목이 없습니다.');
            return;
        }

        $('#download-tbl').find('#FASTQ_all').prop('checked', true).change();
        startDownloadFASTQ($(this).attr('href'), 'all');
    });

    $(document).on('click', '.FASTQ-cancel-download', function () {
        if (!FASTQ_DOWNLOAD_STATUS) return;

        clearInterval(pollTimer);
        FASTQ_DOWNLOAD_STATUS = false;
        
        $('.bg-box.type-info').hide();
        console.log('download cancel');
        // 필요하면 서버에 job 취소 요청도 별도로 보내기
    });

    const startDownloadFASTQ = (url, type) => {
        FASTQ_DOWNLOAD_STATUS = true;

        if (type === 'all') {
            $('.all-download-progress').show();
            $('.bg-box .desc').text('압축 파일 생성 중...');
        } else {

        }

        $.post(url).done(function (res) {
            const jobId = res.job_id;
            pollZipProgress(jobId);
        });
    }

    const pollZipProgress = (jobId) => {
        pollTimer = setInterval(function () {
            $.get(`/fastq/zip-progress/${jobId}`).done(function (res) {

                if (res.status === 'processing') {
                    $('.download-progress-bar progress.all').val(res.percent);
                    $('.download-progress-bar .value').attr('data-value', res.percent).text(res.percent + '%');
                }

                if (res.status === 'done') {
                    clearInterval(pollTimer);
                    FASTQ_DOWNLOAD_STATUS = false;
                    $('.bg-box .desc').text('다운로드를 시작합니다...');

                    // 실제 파일 전송은 브라우저 네이티브 다운로드에 위임 (메모리에 안 올림)
                    location.href = res.download_url;

                    setTimeout(() => $('.bg-box.type-info').hide(), 1000);
                }

                if (res.status === 'not_found') {
                    clearInterval(pollTimer);
                    FASTQ_DOWNLOAD_STATUS = false;
                    $('.bg-box.type-info').hide();
                    alert('다운로드 정보를 찾을 수 없습니다.');
                }
            });
        }, 1000);
    }
</script>