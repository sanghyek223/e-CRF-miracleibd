<div class="subcon-tab-conbox" id="FASTQ-conbox" style="display: none;">
    <div class="table-wrap">
        <table class="cst-table type-regist mypage-tbl">
            <caption class="hide">마이페이지 | 승인 내역</caption>
            <colgroup>
                <col style="width:auto">
                <col style="width:33%">
                <col style="width:33%;">
            </colgroup>

            <thead>
            <tr>
                <th scope="col">대상자 ID</th>
                <th scope="col">파일명</th>
                <th scope="col">용량</th>
            </tr>
            </thead>

            <tbody>
            @foreach($patientsFASTQ as $row)
                @php
                    $file_names = $row->FASTQ->getFileNameAll();
                    $file_sizes = $row->FASTQ->getFileSizeAll();
                @endphp

                @foreach($file_names as $key => $file_name)
                    <tr>
                        <td>
                            @if($key === 0)
                                {{ $row->regist_num }}
                            @endif
                        </td>
                        <td>{{ $file_name }}</td>
                        <td>{{ formatBytes($file_sizes[$key]) }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="btn-wrap text-center">
        <a href="javascript:void(0);" class="btn btn-type1 color-type5 approval-confirm">확인</a>
    </div>
</div>