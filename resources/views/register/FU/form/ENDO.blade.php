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
            <td colspan="3" class="text-left">
                <div class="form-group date">
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center">
                    <img src="/assets/image/icon/ic_cal.png" alt="">
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                내시경 Severity
                <a href="#n" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                                                                MES : 0,1,2,3<br>
                                                                UCEIS : 0~1, 2~4, 5~6, 7~8<br>
                                                                SES-CD : 0~2, 3~6, 7~9, 10~
                                                            </span>
                </a>
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive (remission)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> mild</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> moderate</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> severe</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                소장내시경 검사일
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group date">
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center">
                    <img src="/assets/image/icon/ic_cal.png" alt="">
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                소장내시경 Severity
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> inactive (remission)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> mild</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> moderate</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> severe</label></div>
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