@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">Outcome</h3>
        </div>

        @include("register.include.info")

        @include("register.include.tab", ['type' => 'OUT'])

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form id="OUT-frm" method="post" data-sid="{{ enCryptString($register->sid ?? 0) }}" data-case="{{ $tab }}-update" data-regist_num="{{ $patient->regist_num }}">
                    <fieldset>
                        <legend class="hide">Outcome</legend>

                        @include("register.OUT.form.{$tab}")

                        <div class="btn-wrap text-center">
                            <button type="submit" class="btn btn-type1 color-type2">저장</button>
                            @if($tab != 'V')
                                <button type="button" class="btn btn-type1 color-type1" id="next-submit">저장 후 다음정보 등록</button>
                            @endif
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#OUT-frm';
        const dataUrl = @json(route("register.OUT.data", ['tab' => $tab]));

        $(document).on('submit', form, function () {
            submitAction();
        });

        $(document).on('click', `${form} #next-submit`, function () {
            submitAction(true);
        });
    </script>
    @stack('register-script')
@endsection