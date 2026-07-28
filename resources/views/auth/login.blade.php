@extends('layouts.guest-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="wrap login">
        <div class="login-wrap">
            <h3 class="login-tit">
                마이크로바이옴 레지스트리<br>
                <span class="fz-small">Microbiome Registry</span>
            </h3>

            <p class="info-text">
                본 사이트는 Microbiome Registry와 <br>해당기관만 접속하실 수 있습니다.
            </p>

            <form id="login-frm" method="post">
                <fieldset>
                    <legend class="hide">로그인</legend>
                    <div class="login-input-wrap">
                        <div class="login-input">
                            <input type="text" name="uid" id="uid" class="form-item" placeholder="아이디를" noneSpace>
                            <input type="password" name="password" id="password" class="form-item" placeholder="비밀번호를" noneSpace>
                        </div>

                        <button type="submit" class="btn btn-login">로그인</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#login-frm';
        const dataUrl = '{{ route('login') }}';

        $(document).on('submit', form, function () {

            const uid = $('#uid');
            if (isEmpty(uid.val())) {
                alert('아이디를 입력 해주세요.');
                uid.focus();
                return false;
            }

            const password = $('#password');
            if (isEmpty(password.val())) {
                alert('비밀번호를 입력 해주세요.');
                password.focus();
                return false;
            }

            callAjax(dataUrl, formSerialize(form));
        });
    </script>
@endsection
