@php
    $imgConfig = $registerConfig['FU']['IMG'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Follow-up | 검체 획득 시점 영상</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">검체 획득 시점 영상</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                영상의학 검사일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="FU_img_d_y" :data="$register->FU_img_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_img_d_m" :data="$register->FU_img_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_img_d_d" :data="$register->FU_img_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_img_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Severity
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['FU_img_sev'] as $key => $val)
                        <x-input.radio field="FU_img_sev" value="{{ $key }}" :text="$val" :data="$register->FU_img_sev"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Involved segment
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="checkbox-wrap n5">
                    @foreach($imgConfig['FU_inv_seg'] as $key => $val)
                        <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Fistula
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['FU_fistula'] as $key => $val)
                        <x-input.radio field="FU_fistula" value="{{ $key }}" :text="$val" :data="$register->FU_fistula"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Stricture
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['FU_stricture'] as $key => $val)
                        <x-input.radio field="FU_stricture" value="{{ $key }}" :text="$val" :data="$register->FU_stricture"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Abscess
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($imgConfig['FU_abscess'] as $key => $val)
                        <x-input.radio field="FU_abscess" value="{{ $key }}" :text="$val" :data="$register->FU_abscess"/>
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
    </script>
@endpush