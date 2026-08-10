<form id="download-frm">
    <fieldset>
        <legend class="hide">데이터 열람 / 신청</legend>

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
            <table class="cst-table">
                <caption class="hide">마이페이지 | 신청내역 다운로드 상세</caption>
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
                <tr>
                    <td>
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>
                        HHH-0001
                    </td>
                    <td>
                        HHH-0001_n1.fastq.gz
                    </td>
                    <td>
                        1.5 GB
                    </td>
                    <td class="progress-state">
                        <strong class="text-blue">완료</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>
                        HHH-0001
                    </td>
                    <td>
                        HHH-0001_n1.fastq.gz
                    </td>
                    <td>
                        1.5 GB
                    </td>
                    <td class="progress-state">
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
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>
                        HHH-0001
                    </td>
                    <td>
                        HHH-0001_n1.fastq.gz
                    </td>
                    <td>
                        1.5 GB
                    </td>
                    <td class="progress-state">
                        대기
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>
                        HHH-0001
                    </td>
                    <td>
                        HHH-0001_n1.fastq.gz
                    </td>
                    <td>
                        1.5 GB
                    </td>
                    <td class="progress-state">
                        <a href="#n" class="btn btn-type1 btn-line color-type3"><span class="icon mr-10"><img src="/assets/image/icon/ic_download.png" alt=""></span>다운로드</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox-wrap text-center">
                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                        </div>
                    </td>
                    <td>
                        HHH-0001
                    </td>
                    <td>
                        HHH-0001_n1.fastq.gz
                    </td>
                    <td>
                        1.5 GB
                    </td>
                    <td class="progress-state">
                        <a href="#n" class="btn btn-type1 btn-line color-type3"><span class="icon mr-10"><img src="/assets/image/icon/ic_download.png" alt=""></span>다운로드</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="mt-10 text-right">
                *전체 다운로드 시, 압축 파일(.zip) 형태로 제공됩니다.
            </p>
        </div>

        <div class="btn-wrap text-center">
            <button type="submit" class="btn btn-type1 btn-line color-type2">선택 다운로드</button>
            <button type="submit" class="btn btn-type1 color-type2">전체 다운로드</button>
            <button type="submit" class="btn btn-type1 color-type6">다운로드 취소</button>
        </div>
    </fieldset>
</form>

@push('download-script')
    <script>
        const downloadForm = '#download-frm';
    </script>
@endpush