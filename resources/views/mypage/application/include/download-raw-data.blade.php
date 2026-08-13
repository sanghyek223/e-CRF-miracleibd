<div class="subcon-tab-conbox"  id="raw-data-conbox" @if($data_scope_type['data_scope_file']) style="display: none;" @endif>
    <div class="table-wrap">
        @include('data.include.backup1-tbl', [
            'backup1_count' => $patients_count,
            'addClass' => 'type-regist mypage-tbl'
        ])
    </div>

    @if($application->isDownloadPeriod())
        <div class="btn-wrap text-center mt-20">
            <a href="{{ route('mypage.application.download.excel', ['sid' => $application->sid, 'backup' => 'backup1']) }}" class="btn btn-type1 color-type4 excel-backup1">
                Excel 다운로드
            </a>
        </div>
    @endif

    <div class="table-wrap mt-60">
        @include('data.include.backup2-tbl', [
            'backup2_count' => $followup_count,
            'addClass' => 'type-regist mypage-tbl'
        ])
    </div>

    @if($application->isDownloadPeriod())
        <div class="btn-wrap text-center mt-20">
            <a href="{{ route('mypage.application.download.excel', ['sid' => $application->sid, 'backup' => 'backup2']) }}" class="btn btn-type1 color-type4 excel-backup2">
                Excel 다운로드
            </a>
        </div>
    @endif
</div>

@push('raw-data-script')
    @include('data.include.backup-tbl-script')
@endpush