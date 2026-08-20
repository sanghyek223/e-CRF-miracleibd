let activeControllers = []; // AbortController 목록 (취소용)
let isAllDownloading = false; // 전체 다운로드 진행 여부
const activeRowDownloads = new Set(); // 현재 다운로드 중인 TARGET_ID 저장
const DEFAULT_FILENAME = 'FASTQ_DOWNLOAD.zip';

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
    activeControllers.forEach(c => c.abort());
    activeControllers = [];
});

// 단일 다운로드
$(document).on('click', '.FASTQ-one-download', function (e) {
    e.preventDefault();

    if (isAllDownloading) {
        alert('전체 다운로드가 진행 중입니다.');
        return;
    }

    const download_link = $(this).attr('href');
    const choiceTarget = $(this).closest('tr').find('.FASTQ-chk');
    const TARGET_ID = choiceTarget.attr('id');

    // 이미 다운로드 중인 항목일 경우 차단
    if (activeRowDownloads.has(TARGET_ID)) {
        alert('이미 다운로드가 진행 중인 항목입니다.');
        return;
    }

    choiceTarget.prop('checked', true).trigger('change');

    downloadFASTQRow(download_link, choiceTarget.val(), TARGET_ID);
});

// 선택 다운로드
$(document).on('click', '.FASTQ-choice-download', function (e) {
    e.preventDefault();

    // 전체 다운로드 중일 경우 차단
    if (isAllDownloading) {
        alert('전체 다운로드가 진행 중입니다.');
        return;
    }

    const download_link = $(this).attr('href');
    const choiceTarget = $('#download-tbl').find('.FASTQ-chk:checked');

    if (choiceTarget.length === 0) {
        alert('선택된 항목이 없습니다.');
        return;
    }

    // 이미 다운로드 중인 항목 필터링 (제외)
    const targetsToDownload = choiceTarget.filter(function () {
        const TARGET_ID = $(this).attr('id');
        return !activeRowDownloads.has(TARGET_ID);
    });

    if (targetsToDownload.length === 0) {
        alert('선택한 모든 항목이 이미 다운로드 중입니다.');
        return;
    }

    // 병렬 실행 (중복 제외된 항목만)
    targetsToDownload.each(function (index, item) {
        const FILE_KEY = $(item).val();
        const TARGET_ID = $(item).attr('id');
        downloadFASTQRow(download_link, FILE_KEY, TARGET_ID);
    });
});

// 전체 다운로드
$(document).on('click', '.FASTQ-all-download', function (e) {
    e.preventDefault();

    // 전체 다운로드가 이미 진행 중인 경우 차단
    if (isAllDownloading) {
        alert('이미 전체 다운로드가 진행 중입니다.');
        return;
    }

    // 개별/선택 다운로드가 이미 진행 중인 경우 차단
    if (activeRowDownloads.size > 0) {
        alert('개별/선택 다운로드가 진행 중입니다. 완료 후 다시 시도해 주세요.');
        return;
    }

    const download_link = $(this).attr('href');
    const choiceTarget = $('#download-tbl').find('.FASTQ-chk');

    if (choiceTarget.length === 0) {
        alert('다운로드 가능한 항목이 없습니다.');
        return;
    }

    choiceTarget.prop('checked', true).trigger('change');

    downloadFASTQAll(download_link, 'PROGRESS-ALL');
});

// 개별 행 다운로드
async function downloadFASTQRow(download_link, FILE_KEY, TARGET_ID) {
    if (activeRowDownloads.has(TARGET_ID)) return;

    // 상태 등록
    activeRowDownloads.add(TARGET_ID);

    try {
        const progressInfo = getProgressBox(`PROGRESS-ROW-${TARGET_ID}`);
        $('#' + TARGET_ID).closest('tr').find('.progress-state').html(progressInfo['progress']);

        const url = download_link + (download_link.includes('?') ? '&' : '?') + 'FILE_KEY=' + encodeURIComponent(FILE_KEY);
        const $box = $('#' + progressInfo['id']);

        await runDownloadProcess(url, $box);
    } finally {
        // 다운로드 완료/취소/에러 상관없이 상태 해제
        activeRowDownloads.delete(TARGET_ID);
    }
}

// 전체 다운로드
async function downloadFASTQAll(download_link, PROGRESS_ID) {
    if (isAllDownloading) return;

    // 상태 등록
    isAllDownloading = true;

    try {
        const progressInfo = getProgressBox(PROGRESS_ID);
        progressInfo['progress'].insertBefore('#download-FASTQ-tbl-wrap');

        const $box = $('#' + progressInfo['id']);

        await runDownloadProcess(download_link, $box);
    } finally {
        // 다운로드 완료/취소/에러 상관없이 상태 해제
        isAllDownloading = false;
    }
}

// 공통 다운로드 실행 로직
async function runDownloadProcess(download_link, $box) {
    const progress = $box.find('progress.all');
    const progressVal = $box.find('.value');
    const progressDesc = $box.find('.progress-desc');

    progress.val(0);
    progressVal.attr('data-value', 0);
    progressDesc.text('다운로드 준비 중...');

    const controller = new AbortController();
    activeControllers.push(controller);

    const tracker = createSpeedTracker();

    let fileStream = null;
    let writer = null;

    try {
        const response = await fetch(download_link, { signal: controller.signal });
        if (!response.ok) throw new Error('다운로드 실패: ' + response.status);

        const filename = getFilename(response, DEFAULT_FILENAME);
        const total = parseInt(response.headers.get('Content-Length'), 10);

        fileStream = streamSaver.createWriteStream(filename, {
            size: total || undefined,
        });
        writer = fileStream.getWriter();

        const reader = response.body.getReader();
        let loaded = 0;

        while (true) {
            const { done, value } = await reader.read();
            if (done) break;

            await writer.write(value);
            loaded += value.length;

            const percent = total ? Math.round((loaded / total) * 100) : 0;
            const { speed, eta } = tracker(loaded, total);

            let progressDescText = ("전송속도 " + (speed > 0 ? formatBytes(speed) + '/초' : '--'));
            progressDescText += ' | ';
            progressDescText += formatTime(eta) + ' 남음';

            progress.val(percent);
            progressVal.attr('data-value', percent);
            progressDesc.text(progressDescText);
        }

        await writer.close();

        progress.val(100);
        progressVal.attr('data-value', 100);
        progressDesc.text('다운로드 완료');

    } catch (err) {
        if (writer) {
            try { await writer.abort(); } catch (e) { /* 이미 닫혔으면 무시 */ }
        }

        if (err.name === 'AbortError') {
            progressDesc.text('취소');
        } else {
            console.error(err);
            progressDesc.text('다운로드 실패');
        }
    } finally {
        activeControllers = activeControllers.filter(c => c !== controller);
    }
}

/* ======================= Helper 함수 ============================ */

function getProgressBox(PROGRESS_ID) {
    $('#' + PROGRESS_ID).remove();

    const progress = $($('#progress-template').html());
    progress.attr('id', PROGRESS_ID);

    return {
        id: PROGRESS_ID,
        progress: progress,
    };
}

function getFilename(response, fallback) {
    const disposition = response.headers.get('Content-Disposition');
    if (!disposition) return fallback;

    const utf8Match = disposition.match(/filename\*=UTF-8''([^;]+)/i);
    if (utf8Match) return decodeURIComponent(utf8Match[1]);

    const plainMatch = disposition.match(/filename="?([^";]+)"?/i);
    if (plainMatch) return plainMatch[1];

    return fallback;
}

function formatTime(sec) {
    if (!isFinite(sec) || sec < 0) return '--';
    const m = Math.floor(sec / 60), s = Math.floor(sec % 60);
    return (m > 0 ? m + '분 ' : '') + s + '초';
}

function formatBytes(bytes) {
    if (!bytes) return '0 B';
    const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
}

function createSpeedTracker() {
    let lastTime = performance.now();
    let lastLoaded = 0;
    return function (loaded, total) {
        const now = performance.now();
        const dt = (now - lastTime) / 1000;
        let speed = 0;
        if (dt > 0.3) {
            speed = (loaded - lastLoaded) / dt;
            lastTime = now;
            lastLoaded = loaded;
        }
        const remaining = total - loaded;
        const eta = speed > 0 ? remaining / speed : Infinity;
        return { speed, eta };
    };
}