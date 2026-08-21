@php
    $labConfig = $registerConfig['BASE']['LAB'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 진단 시점 Lab</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">진단 시점 Lab</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">WBC</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_WBC" :data="$register->b_lab_WBC" :disabled="$register->is_WBC_na" class="form-item small text-center chk-active" onlydecimal/> x10³/mm³

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_WBC_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_WBC_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">Hemoglobin</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_Hb" :data="$register->b_lab_Hb" :disabled="$register->is_Hb_na" class="form-item small text-center chk-active" onlydecimal/> x10³/mm³

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_Hb_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_Hb_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">ESR</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_ESR" :data="$register->b_lab_ESR" :disabled="$register->is_ESR_na" class="form-item small text-center chk-active" onlydecimal/> mm/hr

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_ESR_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_ESR_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">Albumin</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_Alb" :data="$register->b_lab_Alb" :disabled="$register->is_Alb_na" class="form-item small text-center chk-active" onlydecimal/> g/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_Alb_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_Alb_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">CRP</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_CRP" :data="$register->b_lab_CRP" :disabled="$register->is_CRP_na" class="form-item small text-center chk-active" onlydecimal/> mg/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_CRP_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_CRP_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">Fecal Calprotectin</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_FC" :data="$register->b_lab_FC" :disabled="$register->is_FC_na" class="form-item small text-center chk-active" onlydecimal/> μg/g

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_FC_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_FC_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">ASCA IgG</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_IgG'] as $key => $val)
                        <x-input.radio field="b_lab_IgG" value="{{ $key }}" :text="$val" :data="$register->b_lab_IgG"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">ASCA IgG 정량</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_IgG_QN" :data="$register->b_lab_IgG_QN" :disabled="$register->is_IgG_QN_na" class="form-item small text-center chk-active" onlydecimal/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_IgG_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_IgG_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">ASCA IgA</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_IgA'] as $key => $val)
                        <x-input.radio field="b_lab_IgA" value="{{ $key }}" :text="$val" :data="$register->b_lab_IgA"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">ASCA IgA 정량</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_IgA_QN" :data="$register->b_lab_IgA_QN" :disabled="$register->is_IgA_QN_na" class="form-item small text-center chk-active" onlydecimal/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_IgA_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_IgA_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">ASCA IgG 분류</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_IgG_cat'] as $key => $val)
                        <x-input.radio field="b_lab_IgG_cat" value="{{ $key }}" :text="$val" :data="$register->b_lab_IgG_cat" onclick="return false;"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">ASCA IgA 분류</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_IgA_cat'] as $key => $val)
                        <x-input.radio field="b_lab_IgA_cat" value="{{ $key }}" :text="$val" :data="$register->b_lab_IgA_cat" onclick="return false;"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ASCA Total 분류
                <a href="javascript:void(0);" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                        IgG, IgA 중 높은 값 채택
                    </span>
                </a>
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap ESS-CHK">
                    @foreach($labConfig['b_lab_ASCA_total'] as $key => $val)
                        <x-input.radio field="b_lab_ASCA_total" value="{{ $key }}" :text="$val" :data="$register->b_lab_ASCA_total" onclick="return false;"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">ANCA</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_ANCA'] as $key => $val)
                        <x-input.radio field="b_lab_ANCA" value="{{ $key }}" :text="$val" :data="$register->b_lab_ANCA"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">ANCA 정량</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_ANCA_QN" :data="$register->b_lab_ANCA_QN" :disabled="$register->is_ANCA_QN_na" class="form-item small text-center chk-active" onlydecimal/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_ANCA_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_ANCA_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Vitamin D</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_VitD" :data="$register->b_lab_VitD" :disabled="$register->is_VitD_na" class="form-item small text-center chk-active" onlydecimal/> ng/mL

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_VitD_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_VitD_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">Folate</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_folate" :data="$register->b_lab_folate" :disabled="$register->is_folate_na" class="form-item small text-center chk-active" onlydecimal/> ng/mL

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_folate_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_folate_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Vitamin B12</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_lab_B12" :data="$register->b_lab_B12" :disabled="$register->is_B12_na" class="form-item small text-center chk-active" onlydecimal/> pg/mL

                <div class="radio-wrap inline ml-10">
                    <x-input.checkbox field="b_lab_B12_na" value="1" text="N/A (획득되지 않음)" :data="$register->b_lab_B12_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">C.difficile toxin</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_Cdiff_toxin'] as $key => $val)
                        <x-input.radio field="b_lab_Cdiff_toxin" value="{{ $key }}" :text="$val" :data="$register->b_lab_Cdiff_toxin"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">C.difficile PCR</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_Cdiff_CPR'] as $key => $val)
                        <x-input.radio field="b_lab_Cdiff_CPR" value="{{ $key }}" :text="$val" :data="$register->b_lab_Cdiff_CPR"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">binary toxin</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_bi_toxin'] as $key => $val)
                        <x-input.radio field="b_lab_bi_toxin" value="{{ $key }}" :text="$val" :data="$register->b_lab_bi_toxin"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">TcDc deletion</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['b_lab_TcDc_del'] as $key => $val)
                        <x-input.radio field="b_lab_TcDc_del" value="{{ $key }}" :text="$val" :data="$register->b_lab_TcDc_del"/>
                    @endforeach
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

        $(document).on('change keyup', '#b_lab_IgG_QN_na, #b_lab_IgG_QN', function () {
            const value = $(form).find('#b_lab_IgG_QN').val();
            const target = 'input[name=b_lab_IgG_cat]';

            if (isEmpty(value)) {
                $(form).find('#b_lab_IgG_QN_na').is(':checked')
                    ? $(form).find(`${target}[value=9]`).prop('checked', true)
                    : $(form).find(`${target}`).prop('checked', false);
            } else {

                if (0 <= value && value < 5) {
                    $(form).find(`${target}[value=0]`).prop('checked', true);
                } else if (5 <= value && value < 15) {
                    $(form).find(`${target}[value=1]`).prop('checked', true);
                } else {
                    $(form).find(`${target}[value=2]`).prop('checked', true);
                }
            }

            ASCA_Total();
        });

        $(document).on('change keyup', '#b_lab_IgA_QN_na, #b_lab_IgA_QN', function () {
            const value = $(form).find('#b_lab_IgA_QN').val();
            const target = 'input[name=b_lab_IgA_cat]';

            if (isEmpty(value)) {
                $(form).find('#b_lab_IgA_QN_na').is(':checked')
                    ? $(form).find(`${target}[value=9]`).prop('checked', true)
                    : $(form).find(`${target}`).prop('checked', false);
            } else {

                if (0 <= value && value < 5) {
                    $(form).find(`${target}[value=0]`).prop('checked', true);
                } else if (5 <= value && value < 15) {
                    $(form).find(`${target}[value=1]`).prop('checked', true);
                } else {
                    $(form).find(`${target}[value=2]`).prop('checked', true);
                }
            }

            ASCA_Total();
        });

        function ASCA_Total () {
            const lgG = $('input[name=b_lab_IgG_cat]:checked').val();
            const lgA = $('input[name=b_lab_IgA_cat]:checked').val();
            const target = 'input[name=b_lab_ASCA_total]';

            if (isEmpty(lgG) || isEmpty(lgA)) {
                $(form).find(target).prop('checked', false);
            } else {
                let maxValue;


                if (lgG == '9' && lgA == '9') {
                    maxValue = 9;
                } else if (lgG == '9') {
                    maxValue = lgA;
                } else if (lgA == '9') {
                    maxValue = lgG;
                } else {
                    maxValue = Math.max(lgG, lgA);
                }

                $(form).find(`${target}[value=${maxValue}]`).prop('checked', true);
            }

            validateEssChk();
        }

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endpush