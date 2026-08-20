@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">End of Study (Last F/U)</h3>
        </div>

        @include("register.include.info")

        @include("register.include.tab", ['type' => 'END'])

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form id="END-frm" method="post" data-sid="{{ enCryptString($register->sid ?? 0) }}" data-case="{{ $tab }}-update" data-regist_num="{{ $patient->regist_num }}">
                    <fieldset>
                        <legend class="hide">End of Study (Last F/U)</legend>

                        @include("register.END.form.{$tab}")

                        <div class="btn-wrap text-center">
                            <button type="submit" class="btn btn-type1 color-type2">저장</button>
                            @if($tab != 'MED')
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
        const form = '#END-frm';
        const dataUrl = @json(route("register.END.data", ['tab' => $tab]));

        $(document).on('submit', form, function () {
            submitAction();
        });

        $(document).on('click', `${form} #next-submit`, function () {
            submitAction(true);
        });
    </script>
    @stack('register-script')
@endsection