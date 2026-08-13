<div class="popup-wrap" style="top: 0; z-index: 11;">
    <div class="popup-contents">
        <div class="popup-tit-wrap">
            <h3 class="popup-tit">반려 사유</h3>
        </div>

        <div class="popup-conbox">
            <form id="application-reject-frm" method="post" data-sid="{{ enCryptString($application->sid) }}" onsubmit="return false;">
                <fieldset>
                    <legend class="hide">반려 사유</legend>

                    <div class="table-wrap nbd">
                        <table class="cst-table">
                            <caption class="hide">반려 사유</caption>
                            <colgroup>
                                <col style="width: 25%;">
                                <col>
                                <col style="width: 25%;">
                                <col>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="row">반려 대상</th>
                                <td colspan="3" class="text-left">{{ $application->applicant }} ({{ $application->getHosName() }})</td>
                            </tr>

                            <tr>
                                <th scope="row">승인 기관</th>
                                <td colspan="3" class="text-left">{{ $application->applicationUserName() }} ({{ $application->getApplicationHosName() }})</td>
                            </tr>

                            <tr>
                                <th scope="row">반려 일시</th>
                                <td colspan="3" class="text-left">{{ $application->confirm_at ?? '' }}</td>
                            </tr>

                            <tr>
                                <th scope="row">반려 사유</th>
                                <td colspan="3" class="text-left">
                                    <x-other.textarea field="reject_reason" :data="$application?->reject_reason" class="form-item" :disabled="true"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:void(0);" class="btn btn-type1 color-type5 layer-close">확인</a>
                    </div>
                </fieldset>
            </form>
        </div>

        <a href="javascript:void(0);" class="btn btn-popup-close layer-close"><span class="hide">팝업 닫기</span></a>
    </div>
</div>