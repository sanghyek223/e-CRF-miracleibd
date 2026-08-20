@php
    $endoConfig = $registerConfig['BASE']['ENDO'];
    
    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 진단 시점 검사</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">진단 시점 검사</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">최초 내시경 검사일</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="b_endo_d_y" :data="$register->b_endo_d_y" :disabled="$register->is_endo_uk" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                    <x-input.text field="b_endo_d_m" :data="$register->b_endo_d_m" :disabled="$register->is_endo_uk" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                    <x-input.text field="b_endo_d_d" :data="$register->b_endo_d_d" :disabled="$register->is_endo_uk" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_endo_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_endo_uk ? 'none' : '' }}">

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_endo_d_uk" value="1" text="Unknown" :data="$register->b_endo_d_uk" :active="true" class="target-active ESS-CHK-NONE"/>
                    </div>
                </div>
            </td>
        </tr>

        @if(!$register->is_uc && !$register->is_cd)
            @include('register.include.none-ibd')
        @else
            @if($register->is_uc)
                <tr>
                    <th scope="row">MES (UC인 경우)</th>
                    <td colspan="3" class="text-left ESS-CHK">
                        <select name="b_MES" id="b_MES" class="form-item w-10p">
                            <option value="">선택</option>
                            @foreach($endoConfig['b_MES'] as $key => $val)
                                <option value="{{ $key }}" {{ ($register->b_MES ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endif

            @if($register->is_cd)
                <tr>
                    <th scope="row">SES-CD (CD인 경우)</th>
                    <td colspan="3" class="text-left ESS-CHK">
                        <select name="b_SES_CD" id="b_SES_CD" class="form-item w-10p">
                            <option value="">선택</option>
                            @foreach($endoConfig['b_SES_CD'] as $key => $val)
                                <option value="{{ $key }}" {{ ($register->b_SES_CD ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endif
        @endif

        <tr>
            <th scope="row">
                내시경 Severity
                <a href="javascript:void(0);" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                        UC MES : 0,1,2,3 <br>
                        SES-CD : 0~2, 3~6, 7~9, 10~
                    </span>
                </a>
            </th>

            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($endoConfig['b_endo_sev'] as $key => $val)
                        <x-input.radio field="b_endo_sev" value="{{ $key }}" :text="$val" :data="$register->b_endo_sev"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">최초 소장내시경 검사일</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="b_entero_d_y" :data="$register->b_entero_d_y" :disabled="$register->is_entero_uk" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                    <x-input.text field="b_entero_d_m" :data="$register->b_entero_d_m" :disabled="$register->is_entero_uk" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                    <x-input.text field="b_entero_d_d" :data="$register->b_entero_d_d" :disabled="$register->is_entero_uk" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_entero_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_entero_uk ? 'none' : '' }}">

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_entero_d_uk" value="1" text="Unknown" :data="$register->b_entero_d_uk" :active="true" class="target-active ESS-CHK-NONE"/>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">소장내시경 Severity</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($endoConfig['b_entero_sev'] as $key => $val)
                        <x-input.radio field="b_entero_sev" value="{{ $key }}" :text="$val" :data="$register->b_entero_sev"/>
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

        $(document).on('change', '#b_MES', function () {
            const value = $(this).val();
            const target = 'input[name=b_endo_sev]';

            (isEmpty(value))
                ? $(form).find(`${target}`).prop('checked', false)
                : $(form).find(`${target}[value=${value}]`).prop('checked', true);

            validateEssChk();
        });

        $(document).on('change', '#b_SES_CD', function () {
            const value = $(this).val();
            const target = 'input[name=b_endo_sev]';

            console.log(value);

            if (isEmpty(value)) {
                $(form).find(`${target}`).prop('checked', false);
            } else {

                switch (value) {
                    case '0':
                    case '1':
                    case '2':
                        $(form).find(`${target}[value=0]`).prop('checked', true);
                        break;

                    case '3':
                    case '4':
                    case '5':
                    case '6':
                        $(form).find(`${target}[value=1]`).prop('checked', true);
                        break;

                    case '7':
                    case '8':
                    case '9':
                        $(form).find(`${target}[value=2]`).prop('checked', true);
                        break;

                    default:
                        $(form).find(`${target}[value=3]`).prop('checked', true);
                        break;
                }
            }

            validateEssChk();
        });

        $(document).on('change', `${form} #b_endo_d_uk, ${form} #b_entero_d_uk`, function () {
            const checked = $(this).is(':checked');
            const target = $(this).closest('td').find('.target-replace-datepicker');

            checked
                ? target.hide()
                : target.show();
        });
    </script>
@endpush