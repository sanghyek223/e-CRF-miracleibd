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
                생물학제제 투약 여부
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
                생물학제제 약제 종류
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
                <div class="form-group date">
                    <select name="end_out_v_year" id="end_out_v_year" class="form-item w-20p">
                        <option value="">년</option>
                        @for ($i = $registerConfig['year_end']; $i >= $registerConfig['year_start']; $i--)
                            <option value="{{ $i }}" {{ ($register->end_out_v_year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>

                    <select name="end_out_v_month" id="end_out_v_month" class="form-item w-20p">
                        <option value="">월</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($register->end_out_v_month ?? '') == $i ? 'selected' : '' }}>{{ $i }}월</option>
                        @endfor
                    </select>
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
                <div class="form-group date">
                    <select name="end_ER_adm_year" id="end_ER_adm_year" class="form-item w-20p">
                        <option value="">년</option>
                        @for ($i = $registerConfig['year_end']; $i >= $registerConfig['year_start']; $i--)
                            <option value="{{ $i }}" {{ ($register->end_ER_adm_year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>

                    <select name="end_ER_adm_month" id="end_ER_adm_month" class="form-item w-20p">
                        <option value="">월</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($register->end_ER_adm_month ?? '') == $i ? 'selected' : '' }}>{{ $i }}월</option>
                        @endfor
                    </select>
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
                target.find('select').val('');
                target.hide();
            }

            validateEssChk();
        });
    </script>
@endpush