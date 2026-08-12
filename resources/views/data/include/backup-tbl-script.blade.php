<script>
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
</script>