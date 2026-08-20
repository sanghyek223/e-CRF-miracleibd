@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">Follow-up</h3>
        </div>

        @include("register.include.info")

        @include("register.FU.include.tab", ['tab' => $tab])

        <div class="contents-grid-wrap">
            <div class="left-side-blank"></div>

            <div class="sub-conbox">
                <div class="write-form-wrap">
                    <form id="FU-frm" method="post" data-sid="{{ enCryptString($register->sid ?? 0) }}" data-case="{{ $tab }}-update" data-regist_num="{{ $patient->regist_num }}">
                        <fieldset>
                            <legend class="hide">Follow-up</legend>

                            @include("register.FU.form.{$tab}")

                            <div class="btn-wrap text-center">
                                <button type="submit" class="btn btn-type1 color-type2">저장</button>
                                @if($tab != 'IMG')
                                    <button type="button" class="btn btn-type1 color-type1" id="next-submit">저장 후 다음정보 등록</button>
                                @endif
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
        const form = '#FU-frm';
        const dataUrl = @json(route("register.FU.data", ['tab' => $tab, 'FU_sid' => enCryptString($Fu->sid)]));

        $(document).on('submit', form, function () {
            submitAction();
        });

        $(document).on('click', `${form} #next-submit`, function () {
            submitAction(true);
        });
    </script>
    @stack('register-script')
@endsection