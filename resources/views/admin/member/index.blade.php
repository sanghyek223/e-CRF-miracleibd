@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('admin.layouts.include.sub-tit-wrap')

        <div class="sch-wrap">
            <form id="sch-frm">
                <fieldset>
                    <legend class="hide">회원 관리</legend>

                    <div class="form-group">
                        <select name="" id="" class="form-item sch-cate">
                            <option value="">전체 기관</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="" id="" class="form-item sch-cate">
                            <option value="">이름</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" name="" id="" class="form-item text-center">
                    </div>

                    <div class="form-group date">
                        <span class="text">등록일 :</span>
                        <input type="text" name="" id="" class="form-item text-center">
                        <img src="/assets/image/icon/ic_cal.png" alt="">
                        <span>~</span>
                        <input type="text" name="" id="" class="form-item text-center">
                        <img src="/assets/image/icon/ic_cal.png" alt="">
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
                        <col style="width:8%">
                        <col style="width:14%">
                        <col style="width:14%">
                        <col>
                        <col style="width:14%;">
                        <col style="width:14%">
                        <col style="width:10%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID</th>
                        <th scope="col">이름</th>
                        <th scope="col">기관</th>
                        <th scope="col">등급</th>
                        <th scope="col">등록일</th>
                        <th scope="col">관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            user4
                        </td>
                        <td>
                            김OO
                        </td>
                        <td>
                            B기관
                        </td>
                        <td>
                            <select name="" id="" class="form-item">
                                <option value="">관리자</option>
                                <option value="">PI</option>
                                <option value="">CRC</option>
                            </select>
                        </td>
                        <td>
                            2026-06-11 <br>
                            11:11:11
                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                <a href="#n" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            user4
                        </td>
                        <td>
                            김OO
                        </td>
                        <td>
                            B기관
                        </td>
                        <td>
                            <select name="" id="" class="form-item">
                                <option value="">관리자</option>
                                <option value="">PI</option>
                                <option value="">CRC</option>
                            </select>
                        </td>
                        <td>
                            2026-06-11 <br>
                            11:11:11
                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                <a href="#n" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            user4
                        </td>
                        <td>
                            김OO
                        </td>
                        <td>
                            B기관
                        </td>
                        <td>
                            <select name="" id="" class="form-item">
                                <option value="">관리자</option>
                                <option value="">PI</option>
                                <option value="">CRC</option>
                            </select>
                        </td>
                        <td>
                            2026-06-11 <br>
                            11:11:11
                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                <a href="#n" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            user4
                        </td>
                        <td>
                            김OO
                        </td>
                        <td>
                            B기관
                        </td>
                        <td>
                            <select name="" id="" class="form-item">
                                <option value="">관리자</option>
                                <option value="">PI</option>
                                <option value="">CRC</option>
                            </select>
                        </td>
                        <td>
                            2026-06-11 <br>
                            11:11:11
                        </td>
                        <td>
                            <div class="btn-wrap">
                                <a href="#n" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                <a href="#n" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{ $list->links('pagination::custom') }}

            <div class="btn-wrap text-right mt-20">
                <a href="#n" class="btn btn-type1 color-type2">등록</a>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('member.data') }}';
    </script>
@endsection
