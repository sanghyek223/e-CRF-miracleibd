@php
    /*
        기본 사용법 Components 호출시
        : 없으면 → 문자열
        : 있으면 → PHP 표현식

        field' => 필드명 (필수) - 문자열
        value' => value 값 (필수) - 문자열
        text => 노출 명 (필수) - 문자열
        :data' => 데이터 (필수) - PHP 데이터

        :active => .target-active 클래스 사용시 필수값으로 (true or false)
         상위 태그 td 기준 하위 대상 .chk-active 클래스 사용중인 타겟 disabled 속성 활성화 비활성화
         true: 체크시 타겟 대상 비활성화
         false: 체크 해제시 타겟 대상 비활성화

        :active2 => .target-text 클래스 사용시 필수값으로 (true or false)
         상위 태그 .target-box 기준 하위 대상 .chk-text 클래스 사용중인 타겟 disabled 속성 활성화 비활성화
         true: 체크시 타겟 대상 비활성화
         false: 체크 해제시 타겟 대상 비활성화
    */

    $data = $data ?? '';
    $checked = ($data == $value); // 숫자값이 있을수있어서 == 으로 체크
@endphp

<div>
    <label class="checkbox-group">
        <input type="checkbox" id="{{ $field }}" name="{{ $field }}"
               {{ $attributes }}
               @if($checked) checked @endif
               @isset($active) data-active="{{ $active ? 'true' : 'false' }}" @endisset
               @isset($active2) data-active2="{{ $active2 ? 'true' : 'false' }}" @endisset> {!! $text ?? '' !!}
    </label>
</div>