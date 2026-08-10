@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        <div class="sub-conbox">
            <div class="write-form-wrap">
                @include('data.include.sch-frm')

                @include('data.include.application-frm')

                @include('data.include.backup-frm')
                
                @include('data.include.download-frm')
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = @json(route('data.data'));
    </script>
    @stack('sch-script')
    @stack('application-script')
    @stack('backup-script')
    @stack('download-script')
@endsection