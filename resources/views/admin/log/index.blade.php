@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('admin.layouts.include.sub-tit-wrap')

        <div class="log-state-wrap">
            <div class="item type1">
                <p class="tit">전체 신청</p>
                <div class="count">1,100</div>
            </div>

            <div class="item type2">
                <p class="tit">승인 대기</p>
                <div class="count">100</div>
            </div>

            <div class="item type3">
                <p class="tit">승인 완료</p>
                <div class="count">900</div>
            </div>

            <div class="item type4">
                <p class="tit">반려</p>
                <div class="count">100</div>
            </div>
        </div>

        <div class="sch-wrap">
            <form action="" method="">
                <fieldset>
                    <legend class="hide">데이터 신청/승인 로그 검색</legend>

                    <div class="form-group date">
                        <span class="text">신청일 :</span>
                        <input type="text" name="" id="" class="form-item text-center">
                        <img src="/assets/image/icon/ic_cal.png" alt="">
                        <span>~</span>
                        <input type="text" name="" id="" class="form-item text-center">
                        <img src="/assets/image/icon/ic_cal.png" alt="">
                    </div>

                    <div class="form-group">
                        <span class="text">신청 기관 :</span>
                        <select name="" id="" class="form-item sch-cate">
                            <option value="">전체 기관</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <span class="text">제공 기관 :</span>
                        <select name="" id="" class="form-item sch-cate">
                            <option value="" selected>전체 기관</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <span class="text">상태 :</span>
                        <select name="" id="" class="form-item sch-cate state">
                            <option value="" selected>전체</option>
                            <option value="">승인대기</option>
                            <option value="">승인완료</option>
                            <option value="">반려</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="" id="" class="form-item text-center" placeholder="신청자명 검색">
                    </div>

                    <button type="submit" class="btn btn-sch">검색</button>
                    <button type="submit" class="btn btn-reset"><img src="/assets/image/icon/ic_reset.png" alt=""> 검색초기화</button>
                </fieldset>
            </form>
        </div>

        <div class="write-form-wrap mt-40">
            <div class="table-wrap">
                <table class="cst-table type-regist mypage-tbl">
                    <caption class="hide">목록</caption>
                    <colgroup>
                        <col style="width:6%">
                        <col style="width:10%">
                        <col style="width:10%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:16%;">
                        <col style="width:10%">
                        <col style="width:8%;">
                        <col>
                        <col style="width:8%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">신청 기관<br>(신청자)</th>
                        <th scope="col">제공 기관<br>(승인자)</th>
                        <th scope="col">신청일시</th>
                        <th scope="col">처리일시</th>
                        <th scope="col">데이터 범위<br>(다운로드 가능기간)</th>
                        <th scope="col">상태</th>
                        <th scope="col">다운로드 여부</th>
                        <th scope="col">반려 사유</th>
                        <th scope="col">상세</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            A기관 (김OO)
                        </td>
                        <td>
                            B기관 (최OO)
                        </td>
                        <td>
                            2026-01-01 <br>
                            1:11:11
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:23:22
                        </td>
                        <td>
                            FASTQ <br>
                            (2026-01-03 ~ 2026-01-09)
                        </td>
                        <td>
                            <span class="state complete">승인 완료</span>
                        </td>
                        <td>
                            <strong class="text-skyblue">O</strong>
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            A기관 (김OO)
                        </td>
                        <td>
                            E기관 (지OO)
                        </td>
                        <td>
                            2026-01-01 <br>
                            1:11:11
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:23:22
                        </td>
                        <td>
                            FASTQ <br>
                            (2026-01-03 ~ 2026-01-09)
                        </td>
                        <td>
                            <span class="state complete">승인 완료</span>
                        </td>
                        <td>
                            <strong class="text-skyblue">O</strong>
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            B기관 (최OO)
                        </td>
                        <td>
                            C기관
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:22:22
                        </td>
                        <td>

                        </td>
                        <td>
                            FASTQ + Raw Data
                        </td>
                        <td>
                            <span class="state ing">승인 대기</span>
                        </td>
                        <td>
                            -
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            C기관 (박OO)
                        </td>
                        <td>
                            D기관 (정OO)
                        </td>
                        <td>
                            2026-01-01 <br>
                            1:11:11
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:23:22
                        </td>
                        <td>
                            FASTQ <br>
                            (2026-01-03 ~ 2026-01-09)
                        </td>
                        <td>
                            <span class="state complete">승인 완료</span>
                        </td>
                        <td>
                            <strong class="text-red">X</strong>
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5
                        </td>
                        <td>
                            D기관 (정OO)
                        </td>
                        <td>
                            A기관 (임OO)
                        </td>
                        <td>
                            2026-01-01 <br>
                            1:11:11
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:23:22
                        </td>
                        <td>
                            FASTQ + Raw Data
                        </td>
                        <td>
                            <span class="state reject">반료</span>
                        </td>
                        <td>
                            -
                        </td>
                        <td>
                            구체적인 활용 목적 미흡
                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            6
                        </td>
                        <td>
                            H기관 (이OO)
                        </td>
                        <td>
                            H기관
                        </td>
                        <td>
                            2026-01-01 <br>
                            1:11:11
                        </td>
                        <td>
                            2026-01-02 <br>
                            2:23:22
                        </td>
                        <td>
                            FASTQ + Raw Data <br>
                            (2026-01-03 ~ 2026-01-09)
                        </td>
                        <td>
                            <span class="state complete">승인 완료</span>
                        </td>
                        <td>
                            <strong class="text-skyblue">O</strong>
                        </td>
                        <td>

                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-small color-type5" title="보기">보기</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

{{--            {{ $list->links('pagination::custom') }}--}}
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('log.data') }}';
    </script>
@endsection