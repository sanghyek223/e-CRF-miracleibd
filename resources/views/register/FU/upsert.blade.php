@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">{{ $page_title }}</h3>
        </div>

        @include("register.include.info")

        @include("register.include.tab", ['sub_tab_show' => !($type === 'FASTQ' && $tab === 'UPLOAD')])

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form id="register-frm" method="post" data-sid="{{ enCryptString($register->sid ?? 0) }}" data-case="{{ $tab }}-update" data-regist_num="{{ $regist_num }}">
                    <fieldset>
                        <legend class="hide">{{ $page_title }}</legend>

                        @include("register.{$type}.{$tab}")

                        <div class="btn-wrap text-center">
                            <button type="submit" class="btn btn-type1 color-type2">저장</button>
                            <button type="button" class="btn btn-type1 color-type1" id="next-submit">저장 후 다음정보 등록</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const birth = '{{ $patient->birth_d }}';
        const dataUrl = @json(route('register.data', ['type' => $type]));

        $(document).on('submit', form, function () {
            submitAction();
        });

        $(document).on('click', `${form} #next-submit`, function () {
            submitAction(true);
        });
    </script>
    @stack('register-script')
@endsection