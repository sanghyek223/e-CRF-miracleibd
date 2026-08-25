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
            <td>{{ $patient->regist_num }}</td>

            <th scope="row">Initial</th>
            <td>{{ $patient->initial ?? '' }}</td>

            <th scope="row">성별/나이</th>
            <td>{{ $patient->getSex() ?? '' }} / {{ $patient->getAge() }}</td>

            <th scope="row">초기 IBD Type</th>
            <td>{{ $patient->getIBD() }}</td>
        </tr>
        </tbody>
    </table>
</div>