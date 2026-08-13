<!doctype html>
<html lang="ko" class="root-text-sm">
<head>
    @include('layouts.components.baseHead')
    <style>
        .win-popup-wrap .popup-contents {
            border: none !important;
        }

        .popup-wrap .popup-contents {
            max-width: 100% !important;
        }
    </style>
</head>
<body>

<div class="popup-wrap win-popup-wrap">
    <div class="popup-contents">
        @yield('contents')
    </div>
</div>

@include('components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
