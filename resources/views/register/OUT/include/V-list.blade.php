@php
    $vConfig = config('site.register.OUT.V');
    $common_field = "out_visit{$eq}";

    $v_list_radio = $register->{$common_field . '_k'} ?? '';
    $v_list_text = $register->{$common_field . '_w'} ?? '';
    $v_list_date = explode('-', $register->{$common_field . '_d'} ?? '');

    $v_list_date_y = $v_list_date[0] ?? '';
    $v_list_date_m = $v_list_date[1] ?? '';
    $v_list_date_d = $v_list_date[2] ?? '';
@endphp

<tr class="v-list-tr">
    <th scope="row">
        <span class="v-list-eq">{{ $eq }}차</span>
        @if($eq !== 1)
            <a href="javascript:void(0);" class="btn btn-detail-del v-list-del" title="삭제">−</a>
        @endif
    </th>

    <td class="text-left ESS-CHK">
        <div class="radio-wrap text-center">
            @foreach($vConfig['out_visit_k'] as $key => $val)
                <x-input.radio field="{{ $common_field }}_k" value="{{ $key }}" :text="$val" :data="$v_list_radio" class="v-list-radio{{ $key }}"/>
            @endforeach
        </div>
    </td>

    <td class="text-left ESS-CHK">
        <x-input.text field="{{ $common_field }}_w" :data="$v_list_text" class="form-item full v-list-text"/>
    </td>

    <td class="ESS-CHK">
        <div class="form-group date">
            <x-input.text field="{{ $common_field }}_d_y" :data="$v_list_date_y" class="form-item line small text-center v-list-y dateY" maxlength="4" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_m" :data="$v_list_date_m" class="form-item line small text-center v-list-m dateM" maxlength="2" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_d" :data="$v_list_date_d" class="form-item line small text-center v-list-d dateD" maxlength="2" onlynumber/>
            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="{{ $common_field }}_d" data-maxdate="{{ now()->format('Y-m-d') }}">
        </div>
    </td>
</tr>