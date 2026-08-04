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
            <th scope="row">
                WBC
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> x10³/mm³
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                Hemoglobin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> g/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ESR
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> mm/hr
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                Albumin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> g/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                CRP
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> mg/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                Fecal Calprotectin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> μg/g
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgG
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative (&lt;10)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgG 정량
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgA
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative (&lt;10)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgA 정량
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgG 분류
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0~4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5~14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgA 분류
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0~4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5~14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA Total 분류
                <a href="#n" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                                                            IgG, IgA 중 높은 값 채택 (단, 시스템 자동 선택 이후 사용자가 수동으로 값을 변경할 수 있음)
                                                        </span>
                </a>
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0~4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5~14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ANCA
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative (&lt;3.5)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive (&gt;5)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ANCA 정량
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Vitamin D
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> ng/mL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                Folate
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> ng/mL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Vitamin B12
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> pg/mL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                C.difficile toxin
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                C.difficile PCR
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                binary toxin
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not detected</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> detected</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                TcDc deletion
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> not detected</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> detected</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>

    </script>
@endpush