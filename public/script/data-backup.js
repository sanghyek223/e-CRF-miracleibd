$(function () {
    // 	Baseline 체크 여부 확인
    const backup1_BASE_length = $('#backup1-tbl').find('.backup1-BASE').length;
    const backup1_BASE_checked_length = $('#backup1-tbl').find('.backup1-BASE:checked').length;
    $('#backup1-tbl').find('#backup1_BASE').prop('checked', (backup1_BASE_length === backup1_BASE_checked_length));

    // End of Study (Last F/U) 체크 여부 확인
    const backup1_END_length = $('#backup1-tbl').find('.backup1-END').length;
    const backup1_END_checked_length = $('#backup1-tbl').find('.backup1-END:checked').length;
    $('#backup1-tbl').find('#backup1_END').prop('checked', (backup1_END_length === backup1_END_checked_length));

    // Backup Table1 전체 체크 여부 확인
    const backup1_length = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all').length;
    const backup1_checked_length = $('#backup1-tbl').find('input[type=checkbox]:checked').not('#backup1_all').length;
    $('#backup1-tbl').find('#backup1_all').prop('checked', (backup1_length === backup1_checked_length));

    // Follow-up 체크 여부 확인
    const backup2_FU_length = $('#backup2-tbl').find('.backup2-FU').length;
    const backup2_FU_checked_length = $('#backup2-tbl').find('.backup2-FU:checked').length;
    $('#backup2-tbl').find('#backup2_FU').prop('checked', (backup2_FU_length === backup2_FU_checked_length));

    // Backup Table2 전체 체크 여부 확인
    const backup2_length = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all').length;
    const backup2_checked_length = $('#backup2-tbl').find('input[type=checkbox]:checked').not('#backup2_all').length;
    $('#backup2-tbl').find('#backup2_all').prop('checked', (backup2_length === backup2_checked_length));
});

// FASTQ ALL DATA
$(document).on('change', `#FASTQ_all`, function () {
    const checked = $(this).is(':checked');
    const target = $('#FASTQ-tbl').find('.fastq-chk');

    target.prop('checked', checked);
});

// FASTQ 개별 선택
$(document).on('change', `#FASTQ-tbl .fastq-chk`, function () {
    const target = $('#FASTQ-tbl').find('#FASTQ_all');
    const allLength = $('#FASTQ-tbl').find('.fastq-chk').length;
    const checkedLength = $('#FASTQ-tbl').find('.fastq-chk:checked').length;

    target.prop('checked', (allLength === checkedLength));
});

// Backup1 ALL DATA
const backup1AllCheck = () => {
    const target = $('#backup1-tbl').find('#backup1_all');
    const allLength = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all').length;
    const checkedLength = $('#backup1-tbl').find('input[type=checkbox]:checked').not('#backup1_all').length;

    target.prop('checked', (allLength === checkedLength));
}

$(document).on('change', `#backup1_all`, function () {
    const checked = $(this).is(':checked');
    const target = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all');

    target.prop('checked', checked);
});

// Baseline
$(document).on('change', `#backup1-tbl #backup1_BASE`, function () {
    const checked = $(this).is(':checked');
    const target = $('#backup1-tbl').find('.backup1-BASE');

    target.prop('checked', checked);
    backup1AllCheck();
});

$(document).on('change', `#backup1-tbl .backup1-BASE`, function () {
    const target = $('#backup1-tbl').find('#backup1_BASE');
    const allLength = $('#backup1-tbl').find('.backup1-BASE').length;
    const checkedLength = $('#backup1-tbl').find('.backup1-BASE:checked').length;

    target.prop('checked', (allLength === checkedLength));
    backup1AllCheck();
});

// End of Study (Last F/U)
$(document).on('change', `#backup1-tbl #backup1_END`, function () {
    const checked = $(this).is(':checked');
    const target = $('#backup1-tbl').find('.backup1-END');

    target.prop('checked', checked);
    backup1AllCheck();
});

$(document).on('change', `#backup1-tbl .backup1-END`, function () {
    const target = $('#backup1-tbl').find('#backup1_END');
    const allLength = $('#backup1-tbl').find('.backup1-END').length;
    const checkedLength = $('#backup1-tbl').find('.backup1-END:checked').length;

    target.prop('checked', (allLength === checkedLength));
    backup1AllCheck();
});

// Backup2 ALL DATA
const backup2AllCheck = () => {
    const target = $('#backup2-tbl').find('#backup2_all');
    const allLength = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all').length;
    const checkedLength = $('#backup2-tbl').find('input[type=checkbox]:checked').not('#backup2_all').length;

    target.prop('checked', (allLength === checkedLength));
}

$(document).on('change', `#backup2_all`, function () {
    const checked = $(this).is(':checked');
    const target = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all');

    target.prop('checked', checked);
});

// Follow-up
$(document).on('change', `#backup2-tbl #backup2_FU`, function () {
    const checked = $(this).is(':checked');
    const target = $('#backup2-tbl').find('.backup2-FU');

    target.prop('checked', checked);
    backup2AllCheck();
});

$(document).on('change', `#backup2-tbl .backup2-FU`, function () {
    const target = $('#backup2-tbl').find('#backup2_FU');
    const allLength = $('#backup2-tbl').find('.backup2-FU').length;
    const checkedLength = $('#backup2-tbl').find('.backup2-FU:checked').length;

    target.prop('checked', (allLength === checkedLength));
    backup2AllCheck();
});

$(document).on('change', `#backup2-tbl .backup2-FU`, function () {
    const target = $('#backup2-tbl').find('#backup2_FU');
    const allLength = $('#backup2-tbl').find('.backup2-FU').length;
    const checkedLength = $('#backup2-tbl').find('.backup2-FU:checked').length;

    target.prop('checked', (allLength === checkedLength));
    backup2AllCheck();
});

$(document).on('click', '.excel-backup1', function (e) {
    e.preventDefault();

    const excel_link = $(this).attr('href');
    const checked_values = {};

    // 체크된 값들만 배열로 추출
    $('#backup1-tbl').find('input[type=checkbox]:checked').not('#backup1_all').each(function() {
        checked_values[$(this).attr('name')] = $(this).val();
    });

    if (Object.keys(checked_values).length === 0) {
        alert('선택된 항목이 없습니다.');
        return;
    }

    // URL에 파라미터 추가 (기존 쿼리스트링 있는지 여부에 따라 ? 또는 & 분기)
    const separator = excel_link.includes('?') ? '&' : '?';

    // 쿼리스트링으로 변환
    const query = Object.entries(checked_values)
        .map(([name, value]) => `${encodeURIComponent(name)}=${encodeURIComponent(value)}`)
        .join('&');

    location.href = excel_link + separator + query;
});

$(document).on('click', '.excel-backup2', function (e) {
    e.preventDefault();

    const excel_link = $(this).attr('href');
    const checked_values = {};

    // 체크된 값들만 배열로 추출
    $('#backup2-tbl').find('input[type=checkbox]:checked').not('#backup2_all').each(function() {
        checked_values[$(this).attr('name')] = $(this).val();
    });

    if (Object.keys(checked_values).length === 0) {
        alert('선택된 항목이 없습니다.');
        return;
    }

    // URL에 파라미터 추가 (기존 쿼리스트링 있는지 여부에 따라 ? 또는 & 분기)
    const separator = excel_link.includes('?') ? '&' : '?';

    // 쿼리스트링으로 변환
    const query = Object.entries(checked_values)
        .map(([name, value]) => `${encodeURIComponent(name)}=${encodeURIComponent(value)}`)
        .join('&');

    location.href = excel_link + separator + query;
});