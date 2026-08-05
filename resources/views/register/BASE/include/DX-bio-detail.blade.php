@php
    $common_field = "b_bio{$eq}";

    $b_bio_text = $register->{$common_field . '_n'} ?? '';
    $b_bio_date_y = $register->{$common_field . '_d_y'} ?? '';
    $b_bio_date_m = $register->{$common_field . '_d_m'} ?? '';
    $b_bio_date_d = $register->{$common_field . '_d_d'} ?? '';
@endphp

<tr class="bio-detail-tr">
    <th scope="row">
        <span class="bio-detail-eq">{{ $eq }}차</span>
        @if($eq !== 1)
            <a href="javascript:void(0);" class="btn btn-detail-del bio-detail-del" title="삭제">−</a>
        @endif
    </th>

    <td class="text-left ESS-CHK">
        <x-input.text field="{{ $common_field }}_n" :data="$b_bio_text" class="form-item full bio-detail-text"/>
    </td>

    <td class="ESS-CHK">
        <div class="form-group date">
            <x-input.text field="{{ $common_field }}_d_y" :data="$b_bio_date_y" class="form-item line small text-center bio-detail-y dateY" maxlength="4" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_m" :data="$b_bio_date_m" class="form-item line small text-center bio-detail-m dateM" maxlength="2" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_d" :data="$b_bio_date_d" class="form-item line small text-center bio-detail-d dateD" maxlength="2" onlynumber/>
            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="{{ $common_field }}_d" data-maxdate="{{ now()->format('Y-m-d') }}">
        </div>
    </td>
</tr>