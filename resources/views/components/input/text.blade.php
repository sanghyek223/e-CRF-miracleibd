@php

    /*
        기본 텍스트 데이터 - 옵션값으로 생략 가능한 값은 : 사용
        : 없으면 → 문자열, {{ }} 사용
        : 있으면 → PHP 표현식, {{ }} 사용 안함

        field' => 필드명 (필수)
        data' => 데이터 (필수)
        :class => 추가 클래스 [] 배열 형태 (생략 가능)
        :attr => 추가 속성값 [] 형태 (생략 가능)

        :is-disabled = disabled 속성 사용시
    */

    $dataField = $data->{$field} ?? '';
    $isDisabled = ($isDisabled ?? false);
@endphp

<input type="text"
       id="{{ $field }}"
       name="{{ $field }}"
       value="{{ $dataField }}"

        @class($class ?? [])
        {{ $isDisabled ? 'disabled' : '' }}
        {{ implode(' ', $attr ?? []) }}>