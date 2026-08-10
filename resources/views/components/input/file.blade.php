@php

    /*
        기본 사용법 Components 호출시
        : 없으면 → 문자열
        : 있으면 → PHP 표현식

        field' => 필드명 (필수) - 문자열
        accept = .jpg, .jpeg 형태로 작성 필요
    */

    $data = $data ?? '';
    $custom_accept = empty($accept) ? [] : explode(',', $accept);

    foreach ($custom_accept as $key => $val) {
        $data_accept[] = str_replace('.', '', trim($val));
    }
@endphp

<input type="file" id="{{ $field }}" name="{{ $field }}" {{ $attributes }} @if($data_accept) data-accept="{{ implode('|', $data_accept) }}" @endif>