<!doctype html>
<html lang="ko" class="root-text-sm">
<head>
    @include('layouts.components.baseHead')
</head>
<body>

@yield('contents')

@include('components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
