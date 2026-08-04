<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">대상자 정보</caption>
        <colgroup>
            <col style="width:10%;">
            <col>
            <col style="width:10%;">
            <col>
            <col style="width:10%;">
            <col>
            <col style="width:10%;">
            <col>
        </colgroup>

        <tbody>
        <tr>
            <th scope="row">Registration No.</th>
            <td>{{ $regist_num }}</td>

            <th scope="row">Initial</th>
            <td>{{ $patient->initial ?? '' }}</td>

            <th scope="row">성별/나이</th>
            <td>{{ $patient->getSex() ?? '' }} / {{ $patient->age ?? '' }}</td>

            <th scope="row">IBD Type</th>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>