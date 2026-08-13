<div class="subcon-tab-conbox" id="FASTQ-conbox">

    @include('data.include.download-tbl', [
        'addClass' => 'type-regist mypage-tbl'
    ])

    @if($application->isDownloadPeriod())
        <div class="btn-wrap text-center">
            <button type="button" class="btn btn-type1 btn-line color-type2">선택 다운로드</button>
            <button type="button" class="btn btn-type1 color-type2">전체 다운로드</button>
            <button type="button" class="btn btn-type1 color-type6">다운로드 취소</button>
        </div>
    @endif
</div>

@push('FASTQ-script')
    @include('data.include.download-tbl-script')
@endpush