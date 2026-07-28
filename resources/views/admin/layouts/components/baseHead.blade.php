<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes,viewport-fit=cover">
<meta name="format-detection" content="telephone=no, address=no, email=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="Author" content="The Korean Audiological Society">
<meta name="Keywords" content="Microbiome Registry 마이크로바이옴 레지스트리">
<meta name="description" content="Microbiome Registry 마이크로바이옴 레지스트리">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ getAppName() }}@yield('addTitle')</title>

<link rel="icon" href="{{ asset('assets/image/favicon.ico') }}">

@include('admin.layouts.components.baseStyle')
@include('admin.layouts.components.baseScript')