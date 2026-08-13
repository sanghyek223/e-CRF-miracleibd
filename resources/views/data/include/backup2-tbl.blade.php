@php
    $rawData = $rawData ?? null;
    $disabled = $disabled ?? false;
@endphp

<table class="cst-table {{ $addClass ?? '' }}" id="backup2-tbl">
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
                <x-input.checkbox field="backup2_all" value="Y" text="ALL DATA" :disabled="$disabled"/>
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
                <x-input.checkbox id="backup2_FU" field="backup2_FU" value="Y" :checked="$rawData?->backup2_FU" :disabled="$disabled" class="backup-chk"/>
            </div>
        </th>
        <th scope="row" rowspan="4" class="text-left">{{ $registerConfig['type']['FU']['name'] }}</th>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_BX" field="backup2_FU_BX" value="Y" :text="$registerConfig['tab']['FU']['BX']" :checked="$rawData?->backup2_FU_BX" :disabled="$disabled" class="backup-chk backup2-FU"/>
            </div>
        </td>
        <td rowspan="4">{{ number_format($backup2_count) }} 건</td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_LAB" field="backup2_FU_LAB" value="Y" :text="$registerConfig['tab']['FU']['LAB']" :checked="$rawData?->backup2_FU_LAB" :disabled="$disabled" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_ENDO" field="backup2_FU_ENDO" value="Y" :text="$registerConfig['tab']['FU']['ENDO']" :checked="$rawData?->backup2_FU_ENDO" :disabled="$disabled" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup2_FU_IMG" field="backup2_FU_IMG" value="Y" :text="$registerConfig['tab']['FU']['IMG']" :checked="$rawData?->backup2_FU_IMG" :disabled="$disabled" class="backup-chk backup2-FU"/>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<script>
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
</script>