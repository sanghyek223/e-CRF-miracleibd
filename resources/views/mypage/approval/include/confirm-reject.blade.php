<div class="popup-wrap" style="top: 0; z-index: 11;">
    <div class="popup-contents">
        <div class="popup-tit-wrap">
            <h3 class="popup-tit">데이터 신청 반려</h3>
        </div>

        <div class="popup-conbox">
            <form id="approval-reject-frm" method="post" data-sid="{{ enCryptString($approval->sid) }}" data-case="approval-reject" onsubmit="return false;">
                <fieldset>
                    <legend class="hide">데이터 신청 반려</legend>

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
                                <th scope="row">반려 대상</th>
                                <td colspan="3" class="text-left">{{ $approval->applicant }} ({{ $approval->getHosName() }})</td>
                            </tr>

                            <tr>
                                <th scope="row">반려 사유 입력</th>
                                <td colspan="3" class="text-left">
                                    <x-other.textarea field="reject_reason" class="form-item"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:void(0);" class="btn btn-type1 color-type1 layer-close">취소</a>
                        <button type="submit" class="btn btn-type1 color-type6">반려 확정</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <a href="javascript:void(0);" class="btn btn-popup-close layer-close"><span class="hide">팝업 닫기</span></a>
    </div>
</div>