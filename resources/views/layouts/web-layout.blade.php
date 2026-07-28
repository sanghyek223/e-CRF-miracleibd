<!doctype html>
<html lang="ko" class="root-text-sm">
<head>
    @include('layouts.components.baseHead')
</head>
<body>

<div class="wrap">
    @include('layouts.include.header')

    <section id="container">
        @yield('contents')
    </section>

    @include('layouts.include.footer')
</div>

@include('components.spinner')

{{--addScript--}}
@yield('addScript')
</body>
</html>
