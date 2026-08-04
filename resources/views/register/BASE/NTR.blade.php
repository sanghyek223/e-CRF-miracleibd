@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">영양 인자 설문</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                설문 진행 유무
            </th>
            <td class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 예</label></div>
                </div>
            </td>
            <th scope="row">
                설문 작성일자
            </th>
            <td class="text-left">
                <div class="form-group date">
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center"> /
                    <input type="text" name="" id="" class="form-item line small text-center">
                    <img src="/assets/image/icon/ic_cal.png" alt="">
                    <div class="checkbox-wrap inline ml-10">
                        <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Unknown</label></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                설문지 종류
            </th>
            <td class="text-left nbdr">
                <input type="text" name="" id="" class="form-item full">
            </td>
            <td colspan="2" class="nbdl"></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 치료</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">영양 치료</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                영양 치료 여부
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                영양 치료 병행 방식
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 없음 (일반식)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> EEN (6주 이상)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> CDED (phase 1 6주 완료 / 12주 완료)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> CDED + PEN</label></div>
                    <div class="inWrap">
                        <label class="radio-group"><input type="radio" name="" id=""> 기타 식이요법 ( <input type="text" name="" id="" class="form-item large"> )</label>
                        <div class="form-group date">
                            <span class="text">시행일자 :</span>
                            <input type="text" name="" id="" class="form-item line small text-center"> /
                            <input type="text" name="" id="" class="form-item line small text-center"> /
                            <input type="text" name="" id="" class="form-item line small text-center">
                            <img src="/assets/image/icon/ic_cal.png" alt="">
                            <div class="checkbox-wrap inline ml-10">
                                <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Unknown</label></div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                영양 치료 중단
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                영양 치료 중단 사유
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 맛 거부감</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 위장 증상 악화</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 기타 : <input type="text" name="" id="" class="form-item xx-large"></label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 영양 치료</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">식습관 조사</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                음주 여부 (성인만 해당)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                흡연 여부 (성인만 해당)
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                가공식품 섭취
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 매일</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 주 3~4회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 월 3~4회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 거의 먹지 않음</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                BMI
            </th>
            <td class="text-left nbdr">
                {00.0} ㎏/㎡ <!--// 자동연동 부분 -->
            </td>
            <td colspan="2" class="nbdl"></td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>

    </script>
@endpush