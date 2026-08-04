@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">{{ $page_title }}</h3>
        </div>

        @include("register.include.info")

        @include("register.include.tab", ['sub_tab_show' => false])

        <div class="sch-wrap type2">
            <form id="sch-frm">
                <fieldset>
                    <legend class="hide"></legend>

                    <div class="form-group">
                        <span class="text">IBD Type :</span>
                        <select name="" id="" class="form-item sch-cate">
                            <option value="" selected>CD</option><!--// 가장 최근 등록된 진단명을 기본값으로 노출(수정 가능) -->
                        </select>
                    </div>

                    <div class="form-group date">
                        <input type="text" name="" id="" class="form-item line small text-center"> /
                        <input type="text" name="" id="" class="form-item line small text-center"> /
                        <input type="text" name="" id="" class="form-item line small text-center">
                        <img src="/assets/image/icon/ic_cal.png" alt="">
                    </div>

                    <button type="submit" class="btn color-type2">추적 등록</button>
                    <button type="submit" class="btn color-type2">추적 수정</button>
                    <button type="submit" class="btn color-type1">취소</button>
                </fieldset>
            </form>
        </div>

        <div class="sub-conbox mt-40">
            <div class="write-form-wrap">
                <div class="table-wrap">
                    <table class="cst-table type-regist">
                        <caption class="hide">목록</caption>

                        <colgroup>
                            <col style="width:auto">
                            <col style="width:17%">
                            <col style="width:17%;">
                            <col style="width:17%;">
                            <col style="width:17%;">
                            <col style="width:12%;">
                        </colgroup>

                        <thead>
                        <tr>
                            <th scope="col">방문일</th>
                            <th scope="col">검체 정보</th>
                            <th scope="col">검체 획득 시점 Lab</th>
                            <th scope="col">검체 획득 시점 검사</th>
                            <th scope="col">검체 획득 시점 영상</th>
                            <th scope="col">관리<br>(수정/삭제)</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($list ?? [] as $row)
                            <tr>
                                <td>
                                    YYYY-MM-DD
                                </td>
                                <td>
                                    <a href="#n" class="btn btn-view" title="이동">VIEW</a>
                                    <span class="state complete"><b class="mark"></b></span>
                                </td>
                                <td>
                                    <a href="#n" class="btn btn-view" title="이동">VIEW</a>
                                    <span class="state ing"><b class="mark"></b></span>
                                </td>
                                <td>
                                    <a href="#n" class="btn btn-view" title="이동">VIEW</a>
                                    <span class="state waiting"><b class="mark"></b></span>
                                </td>
                                <td>
                                    <a href="#n" class="btn btn-view" title="이동">VIEW</a>
                                    <span class="state waiting"><b class="mark"></b></span>
                                </td>
                                <td>
                                    <div class="btn-wrap">
                                        <a href="#n" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                        <a href="#n" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

{{--                {{ $list->links('pagination::custom') }}--}}
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('register.data', ['type' => $type]) }}';
    </script>
@endsection