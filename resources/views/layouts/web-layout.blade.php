<!doctype html>
<html lang="ko" class="root-text-sm">
<head>
    @include('layouts.components.baseHead')
</head>
<body>

@php
    // 현재 페이지 라우트
    $current_route = request()->route()->getName();

    // 데이터 열람 요청 데이터중 아직 미승인 내역
    $approval_list = thisUser()->approvals()->where('confirm', 'N')->get();
    $approval_ready_count = $approval_list->count();
@endphp

<div class="wrap">
    @include('layouts.include.header')

    <section id="container">
        @yield('contents')
    </section>

    @include('layouts.include.footer')
</div>

@if(empty($_COOKIE['approval-popup']) && $approval_ready_count > 0 && $current_route === 'register')
    <div class="popup-wrap" id="approval-popup" style="top: 0; z-index: 11;">
        <div class="popup-contents">
            <div class="popup-tit-wrap">
                <h3 class="popup-tit">데이터 신청 승인</h3>
            </div>

            <div class="popup-conbox">
                <form method="post">
                    <fieldset>
                        <legend class="hide">데이터 신청 승인</legend>

                        <h3 class="popup-sub-tit">신청 정보</h3>

                        @foreach($approval_list as $row)
                            <div class="table-wrap nbd">
                                <table class="cst-table">
                                    <caption class="hide">신청 정보</caption>
                                    <colgroup>
                                        <col style="width: 25%;">
                                        <col>
                                        <col style="width: 25%;">
                                        <col>
                                    </colgroup>

                                    <tbody>
                                    <tr>
                                        <th scope="row">신청자</th>
                                        <td class="text-left">{{ $row->applicant }} ({{ $row->getHosName() }})</td>

                                        <th scope="row">대상자 수</th>
                                        <td class="text-left">{{ number_format($row->dataSearchCount()) }} 건</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">신청 사유</th>
                                        <td colspan="3" class="text-left">{{ $row->reason ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">신청 일자</th>
                                        <td colspan="3" class="text-left">{{ $row->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                        <div class="btn-wrap text-center">
                            <a href="javascript:void(0);" class="btn btn-type1 color-type1 approval-today-close">오늘 그만 보기</a>
                            <a href="{{ route('mypage.approval') }}" class="btn btn-type1 color-type5">바로 확인</a>
                        </div>
                    </fieldset>
                </form>
            </div>
            <a href="javascript:void(0);" class="btn btn-popup-close layer-close"><span class="hide">팝업 닫기</span></a>
        </div>
    </div>
@endif

@include('components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
