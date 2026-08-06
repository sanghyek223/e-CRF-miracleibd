@php
    $medConfig = $registerConfig['OUT']['MED'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | Medication</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">추가 투약 - 생물학적제제 – 1차</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                설문 진행 유무
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_bio1" value="{{ $key }}" :text="$val" :data="$register->out_bio1"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                투약 시작일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date bio1-date">
                    <x-input.text field="out_bio1_d_y" :data="$register->out_bio1_d_y" :disabled="!$register->is_bio1_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="out_bio1_d_m" :data="$register->out_bio1_d_m" :disabled="!$register->is_bio1_y" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="out_bio1_d_d" :data="$register->out_bio1_d_d" :disabled="!$register->is_bio1_y" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="out_bio1_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_bio1_y ? '' : 'none' }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($medConfig['out_bio1_cat'] as $key => $val)
                        <x-input.radio field="out_bio1_cat" value="{{ $key }}" :text="$val" :data="$register->out_bio1_cat"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | Medication</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">추가 투약 - 생물학적제제 – 2차</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                설문 진행 유무
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_bio2" value="{{ $key }}" :text="$val" :data="$register->out_bio2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                투약 시작일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date bio2-date">
                    <x-input.text field="out_bio2_d_y" :data="$register->out_bio2_d_y" :disabled="!$register->is_bio2_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="out_bio2_d_m" :data="$register->out_bio2_d_m" :disabled="!$register->is_bio2_y" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="out_bio2_d_d" :data="$register->out_bio2_d_d" :disabled="!$register->is_bio2_y" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="out_bio2_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_bio2_y ? '' : 'none' }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($medConfig['out_bio2_cat'] as $key => $val)
                        <x-input.radio field="out_bio2_cat" value="{{ $key }}" :text="$val" :data="$register->out_bio2_cat"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | Medication</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">추가 투약 - 생물학적제제 – 3차</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                설문 진행 유무
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_bio3" value="{{ $key }}" :text="$val" :data="$register->out_bio3"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                투약 시작일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date bio3-date">
                    <x-input.text field="out_bio3_d_y" :data="$register->out_bio3_d_y" :disabled="!$register->is_bio3_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="out_bio3_d_m" :data="$register->out_bio3_d_m" :disabled="!$register->is_bio3_y" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="out_bio3_d_d" :data="$register->out_bio3_d_d" :disabled="!$register->is_bio3_y" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="out_bio3_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_bio3_y ? '' : 'none' }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($medConfig['out_bio3_cat'] as $key => $val)
                        <x-input.radio field="out_bio3_cat" value="{{ $key }}" :text="$val" :data="$register->out_bio3_cat"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | Medication</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">추가 투약 - 생물학적제제 – 4차</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                설문 진행 유무
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_bio4" value="{{ $key }}" :text="$val" :data="$register->out_bio4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                투약 시작일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date bio4-date">
                    <x-input.text field="out_bio4_d_y" :data="$register->out_bio4_d_y" :disabled="!$register->is_bio4_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="out_bio4_d_m" :data="$register->out_bio4_d_m" :disabled="!$register->is_bio4_y" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="out_bio4_d_d" :data="$register->out_bio4_d_d" :disabled="!$register->is_bio4_y" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="out_bio4_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_bio4_y ? '' : 'none' }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                약제 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($medConfig['out_bio4_cat'] as $key => $val)
                        <x-input.radio field="out_bio4_cat" value="{{ $key }}" :text="$val" :data="$register->out_bio4_cat"/>
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

        $(document).on('change', `${form} input[name=out_bio1]`, function () {
            const value = $(form).find('input[name=out_bio1]:checked').val() || '';
            const target = $(form).find('.bio1-date');
            const target_text = target.find('input[type=text]');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_calendar.show();
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
                target_calendar.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=out_bio2]`, function () {
            const value = $(form).find('input[name=out_bio2]:checked').val() || '';
            const target = $(form).find('.bio2-date');
            const target_text = target.find('input[type=text]');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_calendar.show();
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
                target_calendar.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=out_bio3]`, function () {
            const value = $(form).find('input[name=out_bio3]:checked').val() || '';
            const target = $(form).find('.bio3-date');
            const target_text = target.find('input[type=text]');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_calendar.show();
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
                target_calendar.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=out_bio4]`, function () {
            const value = $(form).find('input[name=out_bio4]:checked').val() || '';
            const target = $(form).find('.bio4-date');
            const target_text = target.find('input[type=text]');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_calendar.show();
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
                target_calendar.hide();
            }

            validateEssChk();
        });
    </script>
@endpush