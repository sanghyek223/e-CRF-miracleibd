@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form id="patient-frm" method="post" data-sid="{{ enCryptString($patient->sid ?? 0) }}" data-case="patient-{{ empty($patient) ? 'create' : 'update' }}">
                    <fieldset>
                        @include('patient.form.upsert-form')

                        <div class="btn-wrap text-center">
                            <button type="submit" class="btn btn-type1 color-type2">대상자 등록</button>
                            <button type="button" class="btn btn-type1 color-type1" id="next-submit">대상자 등록 후 정보 등록</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('patient.data') }}';
        const form = '#patient-frm';
    </script>

    @stack('patient-script')
@endsection