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
                            <legend class="hide">마이페이지 | 승인 내역</legend>

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
                                    <caption class="hide">마이페이지 | 승인 내역</caption>
                                    <colgroup>
                                        <col style="width:auto">
                                        <col style="width:12%">
                                        <col style="width:15%;">
                                        <col style="width:12%;">
                                        <col style="width:18%;">
                                        <col style="width:12%;">
                                        <col style="width:12%;">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">신청자(신청 기관)</th>
                                        <th scope="col">신청일시</th>
                                        <th scope="col">데이터 범위</th>
                                        <th scope="col">신청목록</th>
                                        <th scope="col">요청 기간</th>
                                        <th scope="col">상태</th>
                                        <th scope="col">관리</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            김OO(A기관)
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ + Raw
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                            </div>
                                        </td>
                                        <td>
                                            2026-01-10 ~ 2026-01-17
                                        </td>
                                        <td>
                                            <span class="state complete">승인 완료</span>
                                        </td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            최OO(B기관)
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            Raw data
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                            </div>
                                        </td>
                                        <td>
                                            2026-01-10 ~ 2026-01-17
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type2" title="승인">승인</a>
                                                <a href="#n" class="btn btn-small color-type6" title="반려">반려</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            최OO(C기관)
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ + Raw
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                            </div>
                                        </td>
                                        <td>
                                            2026-01-10 ~ 2026-01-17
                                        </td>
                                        <td>
                                            <span class="state reject">반려</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type1">반려 취소</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            이OO(D기관)
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                            </div>
                                        </td>
                                        <td>
                                            2026-01-10 ~ 2026-01-17
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type2" title="승인">승인</a>
                                                <a href="#n" class="btn btn-small color-type6" title="반려">반려</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            김OO(E기관)
                                        </td>
                                        <td>
                                            2026-01-01
                                        </td>
                                        <td>
                                            FASTQ
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                            </div>
                                        </td>
                                        <td>
                                            2026-01-10 ~ 2026-01-17
                                        </td>
                                        <td>
                                            <span class="state ing">승인 대기</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="#n" class="btn btn-small color-type2" title="승인">승인</a>
                                                <a href="#n" class="btn btn-small color-type6" title="반려">반려</a>
                                            </div>
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