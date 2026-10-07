@php
    $common_field = "b_bio{$eq}";

    $b_bio_select = $register->{$common_field . '_n'} ?? '';
    $b_bio_date = explode('-', $register->{$common_field . '_d'} ?? '');
    $b_bio_end_date = explode('-', $register->{$common_field . '_end_d'} ?? '');
    $b_bio_load = $register->{$common_field . '_load'} ?? '';
    $b_bio_freq = $register->{$common_field . '_freq'} ?? '';

    $b_bio_date_y = $b_bio_date[0] ?? '';
    $b_bio_date_m = $b_bio_date[1] ?? '';
    $b_bio_date_d = $b_bio_date[2] ?? '';

    $b_bio_end_date_y = $b_bio_end_date[0] ?? '';
    $b_bio_end_date_m = $b_bio_end_date[1] ?? '';
    $b_bio_end_date_d = $b_bio_end_date[2] ?? '';
@endphp

<tr class="bio-detail-tr">
    <th scope="row bio-detail-eq">
        {{ $eq }}차
    </th>

    <td class="ESS-CHK">
        <select name="{{ $common_field }}_n" id="{{ $common_field }}_n" class="form-item full bio-detail-select">
            <option value="">선택</option>
            @foreach($dxConfig['b_bio_n'] as $key => $val)
                <option value="{{ $key }}" @selected($b_bio_select == $key)>{{ $val }}</option>
            @endforeach
        </select>
    </td>

    <td class="ESS-CHK">
        <div class="form-group date">
            <x-input.text field="{{ $common_field }}_d_y" :data="$b_bio_date_y" class="form-item line small text-center bio-detail-y dateY" maxlength="4" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_m" :data="$b_bio_date_m" class="form-item line small text-center bio-detail-m dateM" maxlength="2" onlynumber/> /
            <x-input.text field="{{ $common_field }}_d_d" :data="$b_bio_date_d" class="form-item line small text-center bio-detail-d dateD" maxlength="2" onlynumber/>
            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="{{ $common_field }}_d" data-maxdate="{{ now()->format('Y-m-d') }}">
        </div>
    </td>

    <td class="ESS-CHK">
        <div class="form-group date">
            <x-input.text field="{{ $common_field }}_end_d_y" :data="$b_bio_end_date_y" class="form-item line small text-center bio-detail-end-y dateY" maxlength="4" onlynumber/> /
            <x-input.text field="{{ $common_field }}_end_d_m" :data="$b_bio_end_date_m" class="form-item line small text-center bio-detail-end-m dateM" maxlength="2" onlynumber/> /
            <x-input.text field="{{ $common_field }}_end_d_d" :data="$b_bio_end_date_d" class="form-item line small text-center bio-detail-end-d dateD" maxlength="2" onlynumber/>
            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="{{ $common_field }}_end_d" data-maxdate="{{ now()->format('Y-m-d') }}">
        </div>
    </td>

    <td class="ESS-CHK text-center">
        <x-input.text field="{{ $common_field }}_load" :data="$b_bio_load" class="form-item small text-center bio-detail-load" onlydecimal/> mg
    </td>

    <td class="ESS-CHK text-center">
        <x-input.text field="{{ $common_field }}_freq" :data="$b_bio_freq" class="form-item small text-center bio-detail-freq" onlynumber/> 주
    </td>
</tr>