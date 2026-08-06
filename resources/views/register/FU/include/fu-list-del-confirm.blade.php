<div class="popup-wrap" id="fu-list-del-confirm" style="top: 0; z-index: 11;">
    <div class="popup-contents">
        <div class="popup-tit-wrap">
            <h3 class="popup-tit">추적등록 삭제</h3>
        </div>

        <div class="popup-conbox">
            <form id="Fu-delete-frm" method="post" data-sid="{{ enCryptString($Fu->sid) }}" data-case="Fu-delete" onsubmit="return false;">
                <fieldset>
                    <legend class="hide">추적등록 삭제</legend>

                    <div class="text-box has-icon vertical text-center">
                        <div class="img-wrap"><img src="/assets/image/sub/img_delete.png" alt=""></div>
                        <p>선택하신 데이터를 삭제하시겠습니까? <br><strong>삭제된 데이터는 복구할 수 없습니다.</strong></p>
                    </div>

                    <div class="btn-wrap text-center mt-20">
                        <a href="javascript:$('#fu-list-del-confirm').remove();" class="btn btn-type1 color-type1">취소</a>
                        <button type="submit" class="btn btn-type1 color-type6">삭제</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <a href="javascript:$('#fu-list-del-confirm').remove();" class="btn btn-popup-close"><span class="hide">팝업 닫기</span></a>
    </div>
</div>