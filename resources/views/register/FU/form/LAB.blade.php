@php
    $labConfig = $registerConfig['FU']['LAB'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Follow-up | 검체 획득 시점 Lab</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">검체 획득 시점 Lab</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                대변 검체 획득일
            </th>
            <td class="text-left">{{ $register->FU_feces_dt ?? '' }}</td>

            <th scope="row">
                WBC
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_WBC" :data="$register->FU_lab_WBC" :disabled="$register->is_WBC_na" class="form-item small text-center chk-active"/> x10³/mm³

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_WBC_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_WBC_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Hemoglobin
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_Hb" :data="$register->FU_lab_Hb" :disabled="$register->is_Hb_na" class="form-item small text-center chk-active"/> g/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_Hb_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_Hb_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                ESR
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_ESR" :data="$register->FU_lab_ESR" :disabled="$register->is_ESR_na" class="form-item small text-center chk-active"/> g/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_ESR_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_ESR_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                CRP
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_CRP" :data="$register->FU_lab_CRP" :disabled="$register->is_CRP_na" class="form-item small text-center chk-active"/> mg/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_CRP_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_CRP_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                CRP Category
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_CRP_cat'] as $key => $val)
                        <x-input.radio field="FU_lab_CRP_cat" value="{{ $key }}" :text="$val" :data="$register->FU_lab_CRP_cat"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Albumin
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_alb" :data="$register->FU_lab_alb" :disabled="$register->is_alb_na" class="form-item small text-center chk-active"/> g/dL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_alb_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_alb_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                Fecal Calprotectin
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_FC" :data="$register->FU_lab_FC" :disabled="$register->is_FC_na" class="form-item small text-center chk-active"/> μg/g

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_FC_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_FC_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Fecal Calprotectin Category
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_FC_cat'] as $key => $val)
                        <x-input.radio field="FU_lab_FC_cat" value="{{ $key }}" :text="$val" :data="$register->FU_lab_FC_cat"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                ASCA IgG 정량
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_IgG_QN" :data="$register->FU_lab_IgG_QN" :disabled="$register->is_IgG_QN_na" class="form-item small text-center chk-active"/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_IgG_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_IgG_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ASCA IgG Category 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_IgG_cat1'] as $key => $val)
                        <x-input.radio field="FU_lab_IgG_cat1" value="{{ $key }}" :text="$val" :data="$register->FU_lab_IgG_cat1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                ASCA IgG Category 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_IgG_cat2'] as $key => $val)
                        <x-input.radio field="FU_lab_IgG_cat2" value="{{ $key }}" :text="$val" :data="$register->FU_lab_IgG_cat2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ASCA IgA 정량
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_IgG_QN" :data="$register->FU_lab_IgA_QN" :disabled="$register->is_IgA_QN_na" class="form-item small text-center chk-active"/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_IgA_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_IgA_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                ASCA IgA Category 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_IgA_cat1'] as $key => $val)
                        <x-input.radio field="FU_lab_IgA_cat1" value="{{ $key }}" :text="$val" :data="$register->FU_lab_IgA_cat1"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ASCA IgA Category 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_IgA_cat2'] as $key => $val)
                        <x-input.radio field="FU_lab_IgA_cat2" value="{{ $key }}" :text="$val" :data="$register->FU_lab_IgA_cat2"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                ANCA
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_ANCA'] as $key => $val)
                        <x-input.radio field="FU_lab_ANCA" value="{{ $key }}" :text="$val" :data="$register->FU_lab_ANCA"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ANCA (titer, total)
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_ANCA_total" :data="$register->FU_lab_ANCA_total" :disabled="$register->is_ANCA_total_na" class="form-item small text-center chk-active"/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_ANCA_total_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_ANCA_total_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                ANCA (PR3, 정량)
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_PR3_QN" :data="$register->FU_lab_PR3_QN" :disabled="$register->is_PR3_QN_na" class="form-item small text-center chk-active"/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_PR3_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_PR3_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                ANCA (MPO, 정량)
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_MPO_QN" :data="$register->FU_lab_MPO_QN" :disabled="$register->is_MPO_QN_na" class="form-item small text-center chk-active"/> Units

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_MPO_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_MPO_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>

            <th scope="row">
                C.difficile total
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_Cdiff_total'] as $key => $val)
                        <x-input.radio field="FU_lab_Cdiff_total" value="{{ $key }}" :text="$val" :data="$register->FU_lab_Cdiff_total"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                C.difficile toxin A
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_Cdiff_toxinA'] as $key => $val)
                        <x-input.radio field="FU_lab_Cdiff_toxinA" value="{{ $key }}" :text="$val" :data="$register->FU_lab_Cdiff_toxinA"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                C.difficile toxin A quant
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_Cdiff_toxinA_QN" :data="$register->FU_lab_Cdiff_toxinA_QN" :disabled="$register->is_Cdiff_toxinA_QN_na" class="form-item small text-center chk-active"/> ng/mL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_Cdiff_toxinA_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_Cdiff_toxinA_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                C.difficile toxin B
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_Cdiff_toxinB'] as $key => $val)
                        <x-input.radio field="FU_lab_Cdiff_toxinB" value="{{ $key }}" :text="$val" :data="$register->FU_lab_Cdiff_toxinB"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                C.difficile toxin B quant
            </th>
            <td class="text-left ESS-CHK">
                <x-input.text field="FU_lab_Cdiff_toxinB_QN" :data="$register->FU_lab_Cdiff_toxinB_QN" :disabled="$register->is_Cdiff_toxinB_QN_na" class="form-item small text-center chk-active"/> ng/mL

                <div class="radio-wrap inline ml-10">
                    <x-input.radio field="FU_lab_Cdiff_toxinB_QN_na" value="1" text="N/A (획득되지 않음)" :data="$register->FU_lab_Cdiff_toxinB_QN_na" :active="true" class="target-active ESS-CHK-NONE"/>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                C.difficile PCR
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_lab_Cdiff_PCR'] as $key => $val)
                        <x-input.radio field="FU_lab_Cdiff_PCR" value="{{ $key }}" :text="$val" :data="$register->FU_lab_Cdiff_PCR"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                대변검체획득 시점 <br>Biologics 사용 여부
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="FU_bio" value="{{ $key }}" :text="$val" :data="$register->FU_bio"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="bio-tr" style="display: {{ $register->is_bio_y ? '' : 'none' }}">
            <th scope="row">
                생물학제제 약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($labConfig['FU_bio_cat'] as $key => $val)
                        <x-input.radio field="FU_bio_cat" value="{{ $key }}" :text="$val" :data="$register->FU_bio_cat"/>
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

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('change', `${form} input[name=FU_bio]`, function () {
            const value = $(form).find('input[name=FU_bio]:checked').val() || '';
            const target = $('.bio-tr');

            if (value == '1') {
                target.show();
            } else {
                target.hide();
                target.find('input[type=radio]').prop('checked', false);
            }
        });
    </script>
@endpush