<form id="backup-frm" method="post">
    <fieldset>
        <legend class="hide">데이터 열람 / 신청</legend>

        <div class="sub-tit-wrap">
            <h4 class="sub-contit">백업</h4>
        </div>

        <div class="table-wrap">
            <table class="cst-table" id="backup1-tbl">
                <caption class="hide">백업</caption>
                <colgroup>
                    <col style="width: 15%;">
                    <col style="width: 20%;">
                    <col>
                    <col style="width: 20%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_all" field="backup1_all" value="Y" text="ALL DATA"/>
                        </div>
                    </th>
                    <th scope="col" colspan="2">입력폼</th>
                    <th scope="col">건수</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <th scope="row" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_DEFAULT" field="backup1_DEFAULT" value="Y"/>
                        </div>
                    </th>
                    <th colspan="2" class="text-left">기본 정보</th>
                    <td rowspan="12">{{ number_format($backup1_count) }} 건</td>
                </tr>

                <tr>
                    <th scope="row" rowspan="6" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_BASE" field="backup1_BASE" value="Y"/>
                        </div>
                    </th>
                    <th scope="row" rowspan="6" class="text-left">{{ $registerConfig['type']['BASE']['name'] }}</th>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_DX" field="backup1_BASE_DX" value="Y" :text="$registerConfig['tab']['BASE']['DX']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_ENDO" field="backup1_BASE_ENDO" value="Y" :text="$registerConfig['tab']['BASE']['ENDO']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_IMG" field="backup1_BASE_IMG" value="Y" :text="$registerConfig['tab']['BASE']['IMG']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_LAB" field="backup1_BASE_LAB" value="Y" :text="$registerConfig['tab']['BASE']['LAB']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_NTR" field="backup1_BASE_NTR" value="Y" :text="$registerConfig['tab']['BASE']['NTR']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_BASE_EVN" field="backup1_BASE_EVN" value="Y" :text="$registerConfig['tab']['BASE']['EVN']" class="backup1-BASE"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_OUT_MED" field="backup1_OUT_MED" value="Y"/>
                        </div>
                    </th>
                    <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['MED'] }}</th>
                </tr>

                <tr>
                    <th scope="row" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_OUT_OP" field="backup1_OUT_OP" value="Y"/>
                        </div>
                    </th>
                    <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['OP'] }}</th>
                </tr>

                <tr>
                    <th scope="row" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_OUT_V" field="backup1_OUT_V" value="Y"/>
                        </div>
                    </th>
                    <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['V'] }}</th>
                </tr>

                <tr>
                    <th scope="row" rowspan="2" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup1_END" field="backup1_END" value="Y"/>
                        </div>
                    </th>
                    <th rowspan="2" class="text-left">{{ $registerConfig['type']['END']['name'] }}</th>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_END_ENDO" field="backup1_END_ENDO" value="Y" :text="$registerConfig['tab']['END']['ENDO']" class="backup1-END"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup1_END_MED" field="backup1_END_MED" value="Y" :text="$registerConfig['tab']['END']['MED']" class="backup1-END"/>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-wrap text-center mt-20">
            <a href="#n" class="btn btn-type1 color-type4">Excel 다운로드</a>
        </div>

        <div class="table-wrap mt-80">
            <table class="cst-table" id="backup2-tbl">
                <caption class="hide">백업</caption>
                <colgroup>
                    <col style="width: 15%;">
                    <col style="width: 20%;">
                    <col>
                    <col style="width: 20%;">
                </colgroup>

                <thead>
                <tr>
                    <th scope="col">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox field="backup2_all" value="Y" text="ALL DATA"/>
                        </div>
                    </th>
                    <th scope="col" colspan="2">입력폼</th>
                    <th scope="col">건수</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <th scope="row" rowspan="4" class="bg-gray">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="backup2_FU" field="backup2_FU" value="Y"/>
                        </div>
                    </th>
                    <th scope="row" rowspan="4" class="text-left">{{ $registerConfig['type']['FU']['name'] }}</th>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup2_FU_BX" field="backup2_FU_BX" value="Y" :text="$registerConfig['tab']['FU']['BX']" class="backup2-FU"/>
                        </div>
                    </td>
                    <td rowspan="4">{{ number_format($backup2_count) }} 건</td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup2_FU_LAB" field="backup2_FU_LAB" value="Y" :text="$registerConfig['tab']['FU']['LAB']" class="backup2-FU"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup2_FU_ENDO" field="backup2_FU_ENDO" value="Y" :text="$registerConfig['tab']['FU']['ENDO']" class="backup2-FU"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-left">
                        <div class="checkbox-wrap">
                            <x-input.checkbox id="backup2_FU_IMG" field="backup2_FU_IMG" value="Y" :text="$registerConfig['tab']['FU']['IMG']" class="backup2-FU"/>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-wrap text-center mt-20 mb-80">
            <a href="#n" class="btn btn-type1 color-type4">Excel 다운로드</a>
        </div>
    </fieldset>
</form>

@push('backup-script')
    <script>
        const backupForm = '#backup-frm';

        // Backup1 ALL DATA
        const backup1AllCheck = () => {
            const target = $('#backup1-tbl').find('#backup1_all');
            const allLength = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all').length;
            const checkedLength = $('#backup1-tbl').find('input[type=checkbox]:checked').not('#backup1_all').length;

            target.prop('checked', (allLength === checkedLength));
        }

        $(document).on('change', `${backupForm} #backup1_all`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all');

            target.prop('checked', checked);
        });

        // Baseline
        $(document).on('change', `${backupForm} #backup1-tbl #backup1_BASE`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('.backup1-BASE');

            target.prop('checked', checked);
            backup1AllCheck();
        });

        $(document).on('change', `${backupForm} #backup1-tbl .backup1-BASE`, function () {
            const target = $('#backup1-tbl').find('#backup1_BASE');
            const allLength = $('#backup1-tbl').find('.backup1-BASE').length;
            const checkedLength = $('#backup1-tbl').find('.backup1-BASE:checked').length;

            target.prop('checked', (allLength === checkedLength));
            backup1AllCheck();
        });

        // End of Study (Last F/U)
        $(document).on('change', `${backupForm} #backup1-tbl #backup1_END`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('.backup1-END');

            target.prop('checked', checked);
            backup1AllCheck();
        });

        $(document).on('change', `${backupForm} #backup1-tbl .backup1-END`, function () {
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

        $(document).on('change', `${backupForm} #backup2_all`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all');

            target.prop('checked', checked);
        });

        // Follow-up
        $(document).on('change', `${backupForm} #backup2-tbl #backup2_FU`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup2-tbl').find('.backup2-FU');

            target.prop('checked', checked);
            backup2AllCheck();
        });

        $(document).on('change', `${backupForm} #backup2-tbl .backup2-FU`, function () {
            const target = $('#backup2-tbl').find('#backup2_FU');
            const allLength = $('#backup2-tbl').find('.backup2-FU').length;
            const checkedLength = $('#backup2-tbl').find('.backup2-FU:checked').length;

            target.prop('checked', (allLength === checkedLength));
            backup2AllCheck();
        });
    </script>
@endpush