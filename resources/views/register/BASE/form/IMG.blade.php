@php
    $imgConfig = $registerConfig['BASE']['IMG'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 진단 시점 영상</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">진단 시점 영상</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">최초 영상의학 검사일</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="b_img_d_y" :data="$register->b_img_d_y" :disabled="$register->is_img_uk" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                    <x-input.text field="b_img_d_m" :data="$register->b_img_d_m" :disabled="$register->is_img_uk" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                    <x-input.text field="b_img_d_d" :data="$register->b_img_d_d" :disabled="$register->is_img_uk" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_img_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $register->is_img_uk ? 'none' : '' }}">

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_img_d_uk" value="1" text="Unknown" :data="$register->b_img_d_uk" :active="true" class="target-active ESS-CHK-NONE"/>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                영상의학 검사 종류
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['b_img_k'] as $key => $val)
                        @if($key != '9')
                            <x-input.radio field="b_img_k" value="{{ $key }}" :text="$val" :data="$register->b_img_k"/>
                        @else
                            <div class="inWrap">
                                <x-input.radio2 field="b_img_k" value="{{ $key }}" :text="$val" :data="$register->b_img_k"/>
                                ( <x-input.text field="b_img_k_ow" :data="$register->b_img_k_ow" :disabled="!$register->is_img_k_etc" class="form-item large"/> )
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Severity</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['b_img_sev'] as $key => $val)
                        <x-input.radio field="b_img_sev" value="{{ $key }}" :text="$val" :data="$register->b_img_sev"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="b_img_remi_d-tr" style="display: {{ $register->b_img_sev != '1' ? 'none' : '' }} ">
            <th scope="row">
                Remission 발생일
            </th>

            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="b_img_remi_d_y" :data="$register->b_img_remi_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="b_img_remi_d_m" :data="$register->b_img_remi_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="b_img_remi_d_d" :data="$register->b_img_remi_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_img_remi_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Involved segment</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="checkbox-wrap n5">
                    @foreach($imgConfig['b_inv_seg'] as $key => $val)
                        <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Fistula</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['b_fistula'] as $key => $val)
                        <x-input.radio field="b_fistula" value="{{ $key }}" :text="$val" :data="$register->b_fistula"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Stricture</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['b_stricture'] as $key => $val)
                        <x-input.radio field="b_stricture" value="{{ $key }}" :text="$val" :data="$register->b_stricture"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">Abscess</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['b_abscess'] as $key => $val)
                        <x-input.radio field="b_abscess" value="{{ $key }}" :text="$val" :data="$register->b_abscess"/>
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

        $(document).on('change', `${form} #b_img_d_uk`, function () {
            const checked = $(this).is(':checked');
            const target = $(this).closest('td').find('.target-replace-datepicker');

            checked
                ? target.hide()
                : target.show();
        });

        $(document).on('change', `${form} input[name=b_img_k]`, function () {
            const value = $(form).find('input[name=b_img_k]:checked').val() || '';
            const target_text = $(this).closest('td').find('#b_img_k_ow');

            if (value == '9') {
                target_text.attr('disabled', false);
            } else {
                target_text.val('');
                target_text.attr('disabled', true);
            }

            validateEssChk();
        });

        $(document).on('change', 'input[name=b_img_sev]', function () {
            const value = $(this).val();
            const target = $(form).find('.b_img_remi_d-tr');

            if (value == '1') {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
            }

            validateEssChk();
        });
    </script>
@endpush