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
                    <form id="user-frm" method="post" data-case="user-update">
                        <fieldset>
                            <legend class="hide">마이페이지 | 회원 정보</legend>

                            <div class="table-wrap">
                                <table class="cst-table">
                                    <caption class="hide">기본 정보</caption>
                                    <colgroup>
                                        <col style="width:20%;">
                                        <col>
                                        <col style="width:20%;">
                                        <col>
                                    </colgroup>

                                    <tbody>
                                    <tr>
                                        <th scope="row">기관</th>
                                        <td class="text-left">{{ $user->hospitalName() }}</td>

                                        <th scope="row">성명(아이디)</th>
                                        <td class="text-left">{{ $user->name_kr }} ({{ $user->uid }})</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">이메일</th>
                                        <td class="text-left">
                                            <x-input.text field="email" :data="$user?->email" class="form-item full" nonespace/>
                                        </td>

                                        <th scope="row">현재 비밀번호</th>
                                        <td class="text-left">
                                            <x-input.password field="origin_pwd" class="form-item full" nonespace/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            새 비밀번호<br><span class="text-red2">(8자리 이상, 3자리 조합 필수)</span>
                                        </th>
                                        <td class="text-left">
                                            <x-input.password field="new_pwd" class="form-item full" nonespace/>
                                            <p class="mt-10 text-blue">영문 대소문자/숫자/특수문자 중 3종 포함</p>
                                        </td>

                                        <th scope="row">새 비밀번호 확인</th>
                                        <td class="text-left">
                                            <x-input.password field="new_pwd_confirm" class="form-item full" nonespace/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="{{ route('register') }}" class="btn btn-type1 color-type1">취소</a>
                                <button type="submit" class="btn btn-type1 color-type2">저장</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#user-frm';
        const dataUrl = @json(route('mypage.data'));

        $(document).on('submit', form, function () {
            const email = $(form).find('#email');
            if (isEmpty(email.val())) {
                alert('이메일을 입력해주세요.');
                email.focus();
                return false;
            }

            const origin_pwd = $(form).find('#origin_pwd');
            if (isEmpty(origin_pwd.val())) {
                alert('현재 비밀번호를 입력해주세요.');
                origin_pwd.focus();
                return false;
            }

            const new_pwd = $(form).find('#new_pwd');
            if (isEmpty(new_pwd.val())) {
                alert('새 비밀번호를 입력해주세요.');
                new_pwd.focus();
                return false;
            }

            const new_pwd_confirm = $(form).find('#new_pwd_confirm');
            if (isEmpty(new_pwd_confirm.val())) {
                alert('새 비밀번호를 한번더 입력해주세요.');
                new_pwd_confirm.focus();
                return false;
            }

            if (new_pwd.val() !== new_pwd_confirm.val()) {
                alert('비밀번호가 일치하지 않습니다.');
                new_pwd_confirm.val('');
                new_pwd_confirm.focus();
                return false;
            }

            callMultiAjax(dataUrl, newFormData(form));
        });
    </script>
@endsection