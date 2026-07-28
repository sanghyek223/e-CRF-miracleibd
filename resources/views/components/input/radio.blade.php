@php

    /*
        기본 라디오 데이터 - 옵션값으로 생략 가능한 값은 : 사용
        : 없으면 → 문자열, {{ }} 사용
        : 있으면 → PHP 표현식, {{ }} 사용 안함

        field' => 필드명 (필수)
        value' => 데이터 (필수)
        name' => 노출명 (필수)
        data' => 데이터 객체 (필수)

        :class => 추가 클래스 [] 배열 형태 (생략 가능)
        :attr => 추가 속성값 [] 형태 (생략 가능)

        :is-checked = 체크 여부
        :is-disabled = disabled 속성 사용시
        :is-active => .target-active 클래스 사용시 필수값으로 (true or false) 하위 대상인 .chk-active 클래스 사용중인 타겟 disabled 속성 활성화 비활성화
    */

    $dataField = $data->{$field};

    if (is_null($dataField)) {
        $dataField = '';
    }

    $isChecked = ($dataField == $value);
    $isDisabled = ($isDisabled ?? false);
@endphp

<input type="radio"
       id="{{ $field }}_{{ $value }}"
       name="{{ $field }}"
       value="{{ $value }}"

       @class($class ?? [])
       {{ implode(' ', $attr ?? []) }}
       {{ $isChecked ? 'checked' : '' }}
       {{ $isDisabled ? 'disabled' : '' }}

       @isset($isActive) data-active="{{ $isActive ? 'true' : 'false' }}" @endisset> {!! $name !!}