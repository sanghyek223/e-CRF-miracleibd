<!-- 전체 다운로드 시 노출, 다운로드 취소 버튼 클릭 시 비노출 -->
<div class="bg-box type-info">
    <div class="progress-wrap mb-0">
        <div class="download-progress-bar">
            <progress max="100" value="46" class="all"></progress>
            <div class="value-wrap">
                <p data-value="46" class="value"></p>
            </div>
        </div>
        <div class="desc">
            전송속도 11.1MB/초  |  5분 30초 남음
        </div>
    </div>
</div>
<!--// 전체 다운로드 시 노출, 다운로드 취소 버튼 클릭 시 비노출 -->

<div class="table-wrap">
    <table class="cst-table {{ $addClass ?? '' }}" id="download-tbl">
        <caption class="hide">신청내역 다운로드 상세</caption>

        <colgroup>
            <col style="width:12%">
            <col style="width:14%">
            <col style="width:24%;">
            <col style="width:12%;">
            <col style="width:auto;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">
                <div class="checkbox-wrap text-center">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> ALL DATA</label></div>
                </div>
            </th>
            <th scope="col">대상자 ID</th>
            <th scope="col">파일명</th>
            <th scope="col">용량</th>
            <th scope="col">상태/관리</th>
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
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>{{ $row->regist_num }}</td>
                    <td>{{ $file_name }}</td>
                    <td>{{ formatBytes($file_sizes[$key]) }}</td>
                    <td class="progress-state">
                        <strong class="text-blue">완료</strong>

                        <div class="progress-wrap">
                            <div class="download-progress-bar">
                                <progress max="100" value="30" class="all"></progress>
                                <div class="value-wrap">
                                    <p data-value="30" class="value"></p>
                                </div>
                            </div>
                            <div class="desc">
                                367.9MB/1.2GB
                            </div>
                        </div>


                        대기
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

    <p class="mt-5 text-right text-">
        *압축 파일(.zip) 형태로 제공됩니다.
    </p>
</div>