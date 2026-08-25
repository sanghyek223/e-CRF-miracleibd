<div class="subcon-tab-conbox" id="patient-conbox">
    <div class="table-wrap">
        <table class="cst-table type-regist mypage-tbl">
            <caption class="hide">마이페이지 | 승인 내역</caption>
            <colgroup>
                <col style="width:auto">
                <col style="width:18%">
                <col style="width:18%;">
                <col style="width:18%;">
                <col style="width:20%;">
            </colgroup>

            <thead>
            <tr>
                <th scope="col">대상자 ID</th>
                <th scope="col">등록 날짜</th>
                <th scope="col">성별</th>
                <th scope="col">진단시 나이</th>
                <th scope="col">초기 IBD Type</th>
            </tr>
            </thead>

            <tbody>
            @foreach($patients as $row)
                <tr>
                    <td>{{ $row->regist_num }}</td>
                    <td>{{ $row->created_at->format('Y.m.d') }}</td>
                    <td>{{ $row->getSex() }}</td>
                    <td>{{ $row->getAge() }}</td>
                    <td>{{ $row->getIBD() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="btn-wrap text-center">
        <a href="javascript:void(0);" class="btn btn-type1 color-type5 approval-confirm">확인</a>
    </div>
</div>