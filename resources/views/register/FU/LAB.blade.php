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
            <td class="text-left">
                YYYY / MM / DD
            </td>
            <th scope="row">
                WBC
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> x10³/mm³
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Hemoglobin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> g/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ESR
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> mm/hr
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
                <input type="text" name="" id="" class="form-item line small text-center"> mg/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                CRP Category
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> &lt; 0.1</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0.1 ~ 0.49</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0.5 ~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Albumin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> g/dL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                Fecal Calprotectin
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> μg/g
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Fecal Calprotectin Category
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> &lt; 100</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 100 ~ 249</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> &gt;= 250</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgG 정량
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgG Category 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0 ~ 4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5 ~ 14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15 ~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgG Category 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0 ~ 9.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 10 ~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgA 정량
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ASCA IgA Category 1
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0 ~ 4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5 ~ 14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15 ~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ASCA IgA Category 2
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 0 ~ 4.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5 ~ 14.9</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 15 ~</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ANCA
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> &lt; 3.5, negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> &gt; 5, positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ANCA (titer, total)
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                ANCA (PR3, 정량)
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                ANCA (MPO, 정량)
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> Units
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                C.difficile total
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
                C.difficile toxin A
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                C.difficile toxin A quant
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> ng/mL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                C.difficile toxin B
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
            <th scope="row">
                C.difficile toxin B quant
            </th>
            <td class="text-left">
                <input type="text" name="" id="" class="form-item line small text-center"> ng/mL
                <div class="radio-wrap inline ml-10">
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                C.difficile PCR
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> negative</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> positive</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> N/A (획득되지 않음)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                대변검체획득 시점 <br>Biologics 사용 여부
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Yes</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                생물학제제 약제 종류
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap n4">
                    <div><label class="radio-group"><input type="radio" name="" id=""> infliximab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> vedolizumab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Ustekinumab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> tofacitinib</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> filgotinib</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Upadacitinib</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> ozanimod</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> adalimumab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Golimumab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Risankizumab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Vixarelimab</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> mirikizumab</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>