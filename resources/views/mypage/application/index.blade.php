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
                    <form action="" method="">
                        <fieldset>
                            <legend class="hide">마이페이지 | 신청 내역</legend>

                            <div class="table-contop">
                                <ul class="detail-list">
                                    <li>전체 신청: <strong class="text-blue">n</strong> 건</li>
                                    <li>승인 대기: <strong class="text-blue">n</strong> 건</li>
                                    <li>승인 완료: <strong class="text-blue">n</strong> 건</li>
                                    <li>반려: <strong class="text-red2">n</strong> 건</li>
                                </ul>
                            </div>
                            <div class="table-wrap">
                                <table class="cst-table type-regist mypage-tbl">
                                    <caption class="hide">마이페이지 | 신청 내역</caption>
                                    <colgroup>
                                        <col style="width:auto">
                                        <col style="width:15%">
                                        <col style="width:20%;">
                                        <col style="width:15%;">
                                        <col style="width:15%;">
                                        <col style="width:15%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">신청 기관</th>
                                        <th scope="col">신청일</th>
                                        <th scope="col">데이터 범위</th>
                                        <th scope="col">신청 건수</th>
                                        <th scope="col">진행 상태</th>
                                        <th scope="col">다운로드/관리</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            A기관
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ + Raw
                                        </td>
                                        <td>
                                            3건
                                        </td>
                                        <td>
                                            <span class="state complete">승인 완료</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type2" title="다운로드 상세">다운로드 상세</a>
                                            </div>
                                            <div class="mt-5">(기한: 02.17~02.24)</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            B기관
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            Raw data
                                        </td>
                                        <td>
                                            1건
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            C기관
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ + Raw
                                        </td>
                                        <td>
                                            2건
                                        </td>
                                        <td>
                                            <span class="state reject">반려</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type1">사유 보기</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            D기관
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ
                                        </td>
                                        <td>
                                            2건
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            E기관
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ
                                        </td>
                                        <td>
                                            2건
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
@endsection