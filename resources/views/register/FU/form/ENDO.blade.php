@php
    $endoConfig = $registerConfig['FU']['ENDO'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Follow-up | 검체 획득 시점 검사</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">검체 획득 시점 검사</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                내시경 검사일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="FU_endo_d_y" :data="$register->FU_endo_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_endo_d_m" :data="$register->FU_endo_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_endo_d_d" :data="$register->FU_endo_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_endo_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                내시경 Severity
                <a href="javascript:void(0);" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                        MES : 0,1,2,3<br>
                        SES-CD : 0~2, 3~6, 7~9, 10~
                    </span>
                </a>
            </th>

            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($endoConfig['FU_endo_sev'] as $key => $val)
                        <x-input.radio field="FU_endo_sev" value="{{ $key }}" :text="$val" :data="$register->FU_endo_sev" class="NONE-CLICK"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                소장내시경 검사일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="FU_entero_d_y" :data="$register->FU_entero_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_entero_d_m" :data="$register->FU_entero_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_entero_d_d" :data="$register->FU_entero_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_entero_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                소장내시경 Severity
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($endoConfig['FU_entero_sev'] as $key => $val)
                        <x-input.radio field="FU_entero_sev" value="{{ $key }}" :text="$val" :data="$register->FU_entero_sev"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        const ibd = '{{ $register->ibd_type ?? '' }}';
        const auto_endo_sev = '{{ $register->auto_endo_sev ?? '' }}';

        $(function () {
            validateEssChk();
            autoSev();
        });

        function autoSev() {

            if (isEmpty(auto_endo_sev)) {
                return;
            }

            const target = 'input[name=FU_endo_sev]';

            if (ibd == '1') {
                $(form).find(`${target}[value=${auto_endo_sev}]`).prop('checked', true);
            } else {

                switch (auto_endo_sev) {
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