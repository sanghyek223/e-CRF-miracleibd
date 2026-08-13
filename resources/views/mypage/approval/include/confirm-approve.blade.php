<div class="popup-wrap" style="top: 0; z-index: 11;">
    <div class="popup-contents">
        <div class="popup-tit-wrap">
            <h3 class="popup-tit">데이터 신청 승인</h3>
        </div>
        
        <div class="popup-conbox">
            <form id="approval-approve-frm" method="post" data-sid="{{ enCryptString($approval->sid) }}" data-case="approval-approve" onsubmit="return false;">
                <fieldset>
                    <legend class="hide">데이터 신청 승인</legend>

                    <h3 class="popup-sub-tit">신청 정보 확인</h3>

                    <div class="table-wrap nbd">
                        <table class="cst-table">
                            <caption class="hide">신청 정보</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col>
                                <col style="width: 25%;">
                                <col>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="row">신청자</th>
                                <td class="text-left">{{ $approval->applicant }} ({{ $approval->getHosName() }})</td>

                                <th scope="row">대상자 수</th>
                                <td class="text-left">{{ number_format($approval->dataSearchCount()) }} 건</td>
                            </tr>

                            <tr>
                                <th scope="row">신청 사유</th>
                                <td colspan="3" class="text-left">{{ $approval->reason ?? '' }}</td>
                            </tr>

                            <tr>
                                <th scope="row">신청 일자</th>
                                <td colspan="3" class="text-left">{{ $approval->created_at->format('Y-m-d') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="popup-sub-tit mt-20">다운로드 허용 기간 설정</h3>
                    <div class="table-wrap nbd">
                        <table class="cst-table">
                            <caption class="hide">다운로드 허용 기간 설정</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col>
                                <col style="width: 25%;">
                                <col>
                            </colgroup>
                            <tbody>

                            <tr>
                                <th scope="row">시작 일자</th>
                                <td colspan="3" class="text-left">

                                    <div class="form-group date">
                                        <x-input.text field="download_d_s" :data="$approval->download_d_s?->format('Y-m-d')" class="form-item line short text-center"/>
                                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="download_d_s">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">종료 일자</th>
                                <td colspan="3" class="text-left">
                                    <div class="form-group date">
                                        <x-input.text field="download_d_e" :data="$approval->download_d_e?->format('Y-m-d')" class="form-item line short text-center"/>
                                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="download_d_e">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:void(0);" class="btn btn-type1 color-type1 layer-close">취소</a>
                        <button type="submit" class="btn btn-type1 color-type5">승인 처리</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <a href="javascript:void(0);" class="btn btn-popup-close layer-close"><span class="hide">팝업 닫기</span></a>
    </div>
</div>