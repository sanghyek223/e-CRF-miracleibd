<div class="subcon-tab-conbox" id="FASTQ-conbox">

    @include('data.include.download-tbl', [
        'addClass' => 'type-regist mypage-tbl'
    ])

    @if($application->isDownloadPeriod())
        <div class="btn-wrap text-center">
            <a href="{{ route('mypage.application.download.FASTQ', ['sid' => $application->sid, 'download_type' => 'choice']) }}" class="btn btn-type1 btn-line color-type2 FASTQ-choice-download">선택 다운로드</a>
            <a href="{{ route('mypage.application.download.FASTQ', ['sid' => $application->sid, 'download_type' => 'all']) }}" class="btn btn-type1 color-type2 FASTQ-all-download">전체 다운로드</a>
            <a href="javascript:void(0);" class="btn btn-type1 color-type6 FASTQ-cancel-download">다운로드 취소</a>
        </div>
    @endif
</div>

@push('FASTQ-script')
    <script src="https://cdn.jsdelivr.net/npm/streamsaver@2.0.6/StreamSaver.min.js"></script>
    <script src="{{ asset('script/data-download.js') }}"></script>
@endpush