@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        @include('mypage.include.tab')

        <div class="contents-grid-wrap">
            <div class="left-side-blank"></div>
            <div class="sub-conbox">
                <div class="write-form-wrap">
                    <form id="download-frm" method="post" data-sid="{{ $application->sid }}">
                        <fieldset>
                            <legend class="hide">마이페이지 | 신청 내역</legend>

                            <div class="sub-tit-wrap">
                                <h4 class="sub-contit">다운로드 상세</h4>
                            </div>

                            <div class="bg-box type-info text-center">
                                <ul class="list-type list-type-dot">
                                    <li><span>신청기관</span> {{ $application->getApplicationHosName() }}</li>
                                    <li><span>데이터 범위</span> {{ $application->getDataScope() }}</li>
                                    <li><span>총 대상자</span> {{ number_format($patients_count) }}명</li>
                                    <li><span>기한</span> ~ {{ $application->download_d_e->format('Y.m.d') }}</li>
                                </ul>
                            </div>

                            <div class="subcon-tab-wrap">
                                <ul class="subcon-tab-menu">
                                    @if($data_scope_type['data_scope_file'])
                                        <li class="on">
                                            <a href="javascript:void(0);" class="tab-menu-link" data-scope="FASTQ">
                                                FASTQ ({{ number_format($patients_count) }}건)
                                            </a>
                                        </li>
                                    @endif

                                    @if($data_scope_type['data_scope_row'])
                                        <li @class(['on' => !$data_scope_type['data_scope_file']])>
                                            <a href="javascript:void(0);" class="tab-menu-link" data-scope="raw-data">
                                                Raw Data ({{ number_format($patients_count) }}건)
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            @if($data_scope_type['data_scope_file'])
                                @include('mypage.application.include.download-FASTQ')
                            @endif

                            @if($data_scope_type['data_scope_row'])
                                @include('mypage.application.include.download-raw-data')
                            @endif
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#download-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        $(document).on('click', '.tab-menu-link', function () {
            const scope = $(this).data('scope');

            $('.tab-menu-link').each(function (index, item) {
                const itemScope = $(item).data('scope');
                const conbox = $(`#${itemScope}-conbox`);

                if (itemScope === scope) {
                    $(item).closest('li').addClass('on');
                    conbox.show();
                } else {
                    $(item).closest('li').removeClass('on');
                    conbox.hide();
                }
            });
        });
    </script>
    
    @stack('FASTQ-script')
    @stack('raw-data-script')
@endsection