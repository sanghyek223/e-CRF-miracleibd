@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">End of Study (Last F/U) | 마지막 내시경</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">마지막 내시경</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                내시경 시행일
            </th>
            <td class="text-left">
                <div class="form-group date">
                    <select name="" id="" class="form-item w-20p">
                        <option value="">년</option>
                    </select>
                    <select name="" id="" class="form-item w-20p">
                        <option value="">월</option>
                    </select>
                </div>
            </td>
            <th scope="row">
                평가일
            </th>
            <td class="text-left">
                <div class="form-group date">
                    <select name="" id="" class="form-item w-20p">
                        <option value="">년</option>
                    </select>
                    <select name="" id="" class="form-item w-20p">
                        <option value="">월</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" class="active">
                UC
            </th>
        </tr>
        <tr>
            <th scope="row">
                Location
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> E1 (proctitis)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> E2 (left-sided)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> E3 (extensive)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Undeterminate</label></div>
                </div>
            </td>
            <th scope="row">
                Severity
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> mild</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> moderate</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> severe</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Undeterminate</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4" class="active">
                CD
            </th>
        </tr>
        <tr>
            <th scope="row">
                Location
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> L1 (ileal)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> L2 (colonic)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> L3 (ileocolonic)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Undeterminate</label></div>
                </div>
            </td>
            <th scope="row">
                L4 (Upper GI)
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Yes</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Severity
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> mild</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> moderate</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> severe</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Undeterminate</label></div>
                </div>
            </td>
            <th scope="row">
                Behavior
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> B1</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> B2 (stricturing)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> B3 (penetrating)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                Perianal Modifier
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> No</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> Yes</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>