<div class="subcon-tab-conbox"  id="raw-data-conbox" style="display: none;">
    <div class="table-wrap">
        @include('data.include.backup1-tbl', [
            'backup1_count' => $patients_count,
            'addClass' => 'type-regist form-disabled',
            'disabled' => true,
            'rawData' => $approval,
        ])
    </div>

    <div class="table-wrap mt-40">
        @include('data.include.backup2-tbl', [
            'backup2_count' => $patients_count,
            'addClass' => 'type-regist form-disabled',
            'disabled' => true,
            'rawData' => $approval,
        ])
    </div>

    <div class="btn-wrap text-center">
        <a href="javascript:void(0);" class="btn btn-type1 color-type5 approval-confirm">확인</a>
    </div>
</div>