@php

    /*
        기본 사용법 Components 호출시
        : 없으면 → 문자열
        : 있으면 → PHP 표현식

        field' => 필드명 (필수) - 문자열
        :data' => value (필수) - PHP 데이터
        :disabled = disabled 속성 사용시 - (true or false)
    */

    $data = $data ?? '';
    $disabled = ($disabled ?? false);
@endphp

<input type="password" id="{{ $field }}" name="{{ $field }}" value="{{ $data }}" {{ $attributes }} @if($disabled) disabled @endif>