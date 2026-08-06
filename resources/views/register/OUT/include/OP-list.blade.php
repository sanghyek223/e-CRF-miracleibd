@php
    $common_field = "out_OP{$eq}";

    $op_list_text = $register->{$common_field} ?? '';
    $op_list_date = explode('-', $register->{$common_field . '_dt'} ?? '');
    
    $op_list_date_y = $op_list_date[0] ?? '';
    $op_list_date_m = $op_list_date[1] ?? '';
    $op_list_date_d = $op_list_date[2] ?? '';
@endphp

<tr class="op-list-tr">
    <th scope="row">
        <span class="op-list-eq">{{ $eq }}차</span>
        @if($eq !== 1)
            <a href="javascript:void(0);" class="btn btn-detail-del op-list-del" title="삭제">−</a>
        @endif
    </th>

    <td class="text-left ESS-CHK">
        <x-input.text field="{{ $common_field }}" :data="$op_list_text" class="form-item full op-list-text"/>
    </td>

    <td class="ESS-CHK">
        <div class="form-group date">
            <x-input.text field="{{ $common_field }}_d_y" :data="$op_list_date_y" class="form-item line small text-center op-list-y dateY" maxlength="4" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_m" :data="$op_list_date_m" class="form-item line small text-center op-list-m dateM" maxlength="2" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_d" :data="$op_list_date_d" class="form-item line small text-center op-list-d dateD" maxlength="2" onlynumber/>
            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="{{ $common_field }}_d" data-maxdate="{{ now()->format('Y-m-d') }}">
        </div>
    </td>
</tr>