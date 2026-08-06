@php
    $patient = empty($patient) ? null : $patient->additionalData();
@endphp

<legend class="hide">List of subject</legend>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">기본 정보</caption>
        <colgroup>
            <col style="width:20%;">
            <col>
            <col style="width:20%;">
            <col>
        </colgroup>

        <tbody>
        <tr>
            <th scope="row">Registration No.</th>
            <td class="text-left">{{ $patient->regist_num ?? '(자동 생성)' }}</td>

            <th scope="row">Initial</th>
            <td class="text-left">
                <x-input.text field="initial" :data="$patient?->initial" class="form-item line text-center" enuppercase nonespace/>
            </td>
        </tr>

        <tr>
            <th scope="row">성별</th>
            <td class="text-left">
                <div class="radio-wrap">
                    @foreach($patientConfig['sex'] as $key => $val)
                        <x-input.radio field="sex" value="{{ $key }}" :text="$val" :data="$patient?->sex"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">생년월일</th>
            <td class="text-left">
                <div class="form-group date">
                    <x-input.text field="birth_d_y" :data="$patient?->birth_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="birth_d_m" :data="$patient?->birth_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="birth_d_d" :data="$patient?->birth_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="birth_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">내원 구분</th>
            <td class="text-left nbdr">
                <div class="radio-wrap">
                    @foreach($patientConfig['arrival'] as $key => $val)
                        <x-input.radio field="arrival_chk" value="{{ $key }}" :text="$val" :data="$patient?->arrival_chk"/>
                    @endforeach
                </div>
            </td>

            <td colspan="2" class="nbdl"></td>
        </tr>
        </tbody>
    </table>
</div>

@push('patient-script')
    <script>
        $(document).on('submit', form, function () {

            if (!validationCheck()) {
                return false;
            }

            callMultiAjax(dataUrl, newFormData(form));
        });

        $(document).on('click', '#next-submit', function () {

            if (!validationCheck()) {
                return false;
            }

            let ajaxData = newFormData(form);
            ajaxData.append('next', true);

            callMultiAjax(dataUrl, ajaxData);
        });

        const validationCheck = (_next = false) => {
            const initial = $(form).find('#initial');
            if (isEmpty(initial.val())) {
                alert('영문이름 이니셜을 입력해주세요.');
                initial.focus();
                return false;
            }

            const sex = $(form).find('input[name=sex]');
            if (!sex.is(':checked')) {
                alert('성별을 선택해주세요.');
                sex.eq(0).focus();
                return false;
            }

            const birthStr = $('#birth_d_y').val() + "-" + $('#birth_d_m').val() + '-' + $('#birth_d_d').val();
            const birth = moment(birthStr, 'YYYY-MM-DD', true);

            // 유효성 체크
            if (!birth.isValid()) {
                alert('올바른 생년월일을 입력해주세요.');
                return;
            }

            const arrival = $(form).find('input[name=arrival_chk]');
            if (!arrival.is(':checked')) {
                alert('내원 구분을 선택해주세요.');
                arrival.eq(0).focus();
                return false;
            }

            return true;
        }
    </script>
@endpush