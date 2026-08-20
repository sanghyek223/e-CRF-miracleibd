@php
    $ntrConfig = $registerConfig['BASE']['NTR'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
    $disabled_Tx_d = (!$register->is_Tx_k_etc || !$register->is_Tx_d_uk); // 영양 치료 병행 방식 기타 시행일자 text box disabled 유무
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">영양 인자 설문</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">설문 진행 유무</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_NTR_survey" value="{{ $key }}" :text="$val" :data="$register->b_NTR_survey"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">설문 작성일자</th>
            <td class="text-left ESS-CHK survey-td">
                <div class="form-group date">
                    <x-input.text field="b_NTR_survey_d_y" :data="$register->b_NTR_survey_d_y" :disabled="!$register->is_survey || $register->is_survey_uk" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                    <x-input.text field="b_NTR_survey_d_m" :data="$register->b_NTR_survey_d_m" :disabled="!$register->is_survey || $register->is_survey_uk" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                    <x-input.text field="b_NTR_survey_d_d" :data="$register->b_NTR_survey_d_d" :disabled="!$register->is_survey || $register->is_survey_uk" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_NTR_survey_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ (!$register->is_survey || $register->is_survey_uk) ? 'none' : '' }}">

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_NTR_survey_d_uk" value="1" text="Unknown" :data="$register->b_NTR_survey_d_uk" :active="true" class="target-active ESS-CHK-NONE {{ !$register->is_survey ? 'NONE-CLICK' : '' }}"/>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">설문지 종류</th>
            <td class="text-left nbdr ESS-CHK survey-td">
                <x-input.text field="b_NTR_survey_k" :data="$register->b_NTR_survey_k" :disabled="!$register->is_survey" class="form-item full"/>
            </td>

            <td colspan="2" class="nbdl"></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 치료</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">영양 치료</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">영양 치료 여부</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_NTR_Tx" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Tx-tr" style="display: {{ $register->is_Tx ? '' : 'none' }} ">
            <th scope="row">영양 치료 병행 방식</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($ntrConfig['b_NTR_Tx_k'] as $key => $val)
                        @if($key != '4')
                            <x-input.radio field="b_NTR_Tx_k" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx_k"/>
                        @else
                            <div class="inWrap">
                                <x-input.radio2 field="b_NTR_Tx_k" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx_k"/>
                                ( <x-input.text field="b_NTR_Tx_ow" :data="$register->b_NTR_Tx_ow" :disabled="!$register->is_Tx_k_etc" class="form-item large"/> )
                            </div>

                            <div class="form-group date target-box">
                                <span class="text">시행일자 :</span>
                                <x-input.text field="b_NTR_Tx_d_y" :data="$register->b_NTR_Tx_d_y" :disabled="$register->is_Tx_d_uk" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                                <x-input.text field="b_NTR_Tx_d_m" :data="$register->b_NTR_Tx_d_m" :disabled="$register->is_Tx_d_uk" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                                <x-input.text field="b_NTR_Tx_d_d" :data="$register->b_NTR_Tx_d_d" :disabled="$register->is_Tx_d_uk" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                                <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_NTR_Tx_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_Tx_d_uk ? 'none' : '' }}">

                                <div class="checkbox-wrap inline ml-10">
                                    <x-input.checkbox field="b_NTR_Tx_d_uk" value="1" text="Unknown" :data="$register->b_NTR_Tx_d_uk" :active2="true" class="target-box-active ESS-CHK-NONE"/>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Tx-tr" style="display: {{ $register->is_Tx ? '' : 'none' }} ">
            <th scope="row">영양 치료 중단</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_NTR_Tx_stop" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx_stop"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="stop-tr" style="display: {{ $register->is_stop ? '' : 'none' }} ">
            <th scope="row">영양 치료 중단 사유</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap target-box">
                    @foreach($ntrConfig['b_NTR_Tx_stop_k'] as $key => $val)
                        @if($key != '3')
                            <x-input.radio field="b_NTR_Tx_stop_k" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx_stop_k" :active2="true" class="target-box-active"/>
                        @else
                            <div class="inWrap">
                                <x-input.radio2 field="b_NTR_Tx_stop_k" value="{{ $key }}" :text="$val" :data="$register->b_NTR_Tx_stop_k" :active2="false" class="target-box-active"/>
                                : <x-input.text field="b_NTR_Tx_stop_ow" :data="$register->b_NTR_Tx_stop_ow" :disabled="!$register->is_Tx_stop_k_etc" class="form-item xx-large chk-active"/>
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 치료</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">식습관 조사</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">음주 여부 (성인만 해당)</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_NTR_alc" value="{{ $key }}" :text="$val" :data="$register->b_NTR_alc"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">흡연 여부 (성인만 해당)</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_NTR_S" value="{{ $key }}" :text="$val" :data="$register->b_NTR_S"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">가공식품 섭취</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($ntrConfig['b_NTR_PF'] as $key => $val)
                        <x-input.radio field="b_NTR_PF" value="{{ $key }}" :text="$val" :data="$register->b_NTR_PF"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">BMI</th>
            <td class="text-left nbdr">
                {{ $patient->BaseDX->b_BMI ?? '' }} ㎏/㎡
            </td>

            <td colspan="2" class="nbdl"></td>
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

        $(document).on('change', `${form} input[name=b_NTR_survey]`, function () {
            const value = $(form).find('input[name=b_NTR_survey]:checked').val() || '';
            const target = $(form).find('.survey-td');
            const target_text = target.find('input[type=text]');
            const target_checkbox = target.find('#b_NTR_survey_d_uk');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_checkbox.removeClass('NONE-CLICK');
                target_calendar.show();
            } else {
                target_text.val('');
                target_checkbox.prop('checked', false).change();

                target_text.attr('disabled', true);
                target_checkbox.addClass('NONE-CLICK');
                target_calendar.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_NTR_Tx]`, function () {
            const value = $(form).find('input[name=b_NTR_Tx]:checked').val() || '';
            const target = $(form).find('.Tx-tr');
            const target2 = $(form).find('.stop-tr');

            if (value == '1') {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
                target.find('input[type=radio]').prop('checked', false).change();
                target.find('input[type=checkbox]').prop('checked', false).change();

                target2.hide();
                target2.find('input[type=text]').val('');
                target2.find('input[type=radio]').prop('checked', false).change();
                target2.find('input[type=checkbox]').prop('checked', false).change();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_NTR_Tx_stop]`, function () {
            const value = $(form).find('input[name=b_NTR_Tx_stop]:checked').val() || '';
            const target = $(form).find('.stop-tr');

            if (value == '1') {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
                target.find('input[type=radio]').prop('checked', false).change();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_NTR_Tx_k]`, function () {
            const value = $(form).find('input[name=b_NTR_Tx_k]:checked').val() || '';
            const target_text = $(this).closest('td').find('#b_NTR_Tx_ow');

            if (value == '4') {
                target_text.attr('disabled', false);
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
            }

            validateEssChk();
        });

        $(document).on('change', `${form} #b_NTR_survey_d_uk, ${form} #b_NTR_Tx_d_uk`, function () {
            const checked = $(this).is(':checked');
            const target = $(this).closest('td').find('.target-replace-datepicker');

            checked
                ? target.hide()
                : target.show();
        });
    </script>
@endpush