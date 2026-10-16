@php
    $medConfig = $registerConfig['END']['MED'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">End of Study (Last F/U) | 마지막 F/U 시점의 약제 사용</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">마지막 F/U 시점의 약제 사용</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                약물 투약 여부
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_med" value="{{ $key }}" :text="$val" :data="$register->end_med"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $register->is_med_y ? '' : 'none' }}">
            <th scope="row">
                5-ASA
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_5ASA" value="{{ $key }}" :text="$val" :data="$register->end_5ASA"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                Azathioprine
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_aza" value="{{ $key }}" :text="$val" :data="$register->end_aza"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $register->is_med_y ? '' : 'none' }}">
            <th scope="row">
                Methotrexate
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_MTX" value="{{ $key }}" :text="$val" :data="$register->end_MTX"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                Tofacitinib
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_tofa" value="{{ $key }}" :text="$val" :data="$register->end_tofa"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $register->is_med_y ? '' : 'none' }}">
            <th scope="row">
                Ozanimod
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_oza" value="{{ $key }}" :text="$val" :data="$register->end_oza"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                Steroid
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_st" value="{{ $key }}" :text="$val" :data="$register->end_st"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                상급치료제(advanced therapy) 투약 여부
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_bio" value="{{ $key }}" :text="$val" :data="$register->end_bio"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="bio-tr" style="display: {{ $register->is_bio_y ? '' : 'none' }}">
            <th scope="row">
                상급치료제(advanced therapy) 약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($medConfig['end_bio_cat'] as $key => $val)
                        <x-input.radio field="end_bio_cat" value="{{ $key }}" :text="$val" :data="$register->end_bio_cat"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                마지막 외래 방문일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date survey-date">
                    <x-input.text field="end_out_v_d_y" :data="$register->end_out_v_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="end_out_v_d_m" :data="$register->end_out_v_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="end_out_v_d_d" :data="$register->end_out_v_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="end_out_v_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                입원 또는 응급실 방문
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="end_ER_adm_v" value="{{ $key }}" :text="$val" :data="$register->end_ER_adm_v"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="ER_adm_v-tr" style="display: {{ $register->is_ER_adm_v_y ? '' : 'none' }}">
            <th scope="row">
                최초 입원 또는 응급실 방문 날짜
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date survey-date">
                    <x-input.text field="end_ER_adm_d_y" :data="$register->end_ER_adm_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="end_ER_adm_d_m" :data="$register->end_ER_adm_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="end_ER_adm_d_d" :data="$register->end_ER_adm_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="end_ER_adm_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('change', `${form} input[name=end_med]`, function () {
            const value = $(form).find('input[name=end_med]:checked').val() || '';
            const target = $(form).find('.med-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=radio]').prop('checked', false);
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=end_bio]`, function () {
            const value = $(form).find('input[name=end_bio]:checked').val() || '';
            const target = $(form).find('.bio-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=radio]').prop('checked', false);
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=end_ER_adm_v]`, function () {
            const value = $(form).find('input[name=end_ER_adm_v]:checked').val() || '';
            const target = $(form).find('.ER_adm_v-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });
    </script>
@endpush