@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">환경 인자 설문</th>
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
                설문지 작성일자
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
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 10%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">일상 활동 정도</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4" class="text-left">
                <table class="inner-tbl">
                    <colgroup>
                        <col style="width: 20%;">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th colspan="2" class="text-left">
                            아래는 활동 수준에 따른 신체 활동 예시입니다. <br>
                            직접 기술을 선택하신 경우에는 예시를 확인하시고, 이를 바탕으로 작성해주세요.
                        </th>
                    </tr>
                    <tr>
                        <th>1.0</th>
                        <td class="text-left">수면</td>
                    </tr>
                    <tr>
                        <th>휴식, 여가활동 (1.1~1.9)</th>
                        <td class="text-left">옆으로 눕기, 앉아서 책읽기, 서예, TV시청, 대화, 요리, 식사, 세면, 배변, 바느질, 재봉일, 꽃꽂이, 다도, 카드놀이, 악기연주, 운전, 서류정리, 워드</td>
                    </tr>
                    <tr>
                        <th>저강도 활동 (2.0~2.9)</th>
                        <td class="text-left">지하철/버스 서서 탑승, 쇼핑, 산책, 세탁(세탁기 사용), 청소(청소기 사용)</td>
                    </tr>
                    <tr>
                        <th>중강도 활동 (3.0~5.9)</th>
                        <td class="text-left">정원 손질, 보통속도 걷기, 목욕, 자전거타기, 아기 업고 보행, 게이트볼, 캐치볼, 골프, 가벼운 댄스, 하이킹(평지), 계단 오르기, 이불 널고 걷기</td>
                    </tr>
                    <tr>
                        <th>고강도 활동 (6.0 이상)</th>
                        <td class="text-left">근력 트레이닝, 에어로빅, 노 젓기, 조깅, 테니스, 배드민턴, 배구, 스키, 축구, 스케이트, 수영, 달리기</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th scope="row">
                일상 활동 정도
            </th>
            <td colspan="3" class="text-left">
                <div class="radio-wrap full">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 움직임이 극히 적음</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 대부분의 시간을 앉아서 하는 정적 활동으로 보냄</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 주로 앉아서 보내지만 서서 하는 작업, 통근, 물건구입, 집안일, 가벼운 운동 등</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 주로 서서 하는 작업 종사, 또는 운동 등 활발한 여가 활동</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 직접 기술 <input type="text" name="" id="" class="form-item xx-large"></label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">모유 수유 / 출산력</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 어릴 때 모유 수유를 하셨나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 모유 수유를 하였다면 기간은 어떻게 되나요?
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 개월
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 어머니가 본인을 출산할 때 어떤 방법으로 하셨나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 질식분만</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 제왕절개 (수술)</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">어린시절 병력</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 염증성 장질환 진단 전 장염 또는 식중독으로 입원한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 다음 중 염증성장질환 진단 전 경험한 감염증을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="checkbox-wrap n4">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 홍역</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 백일해</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 풍진</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 수두</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 볼거리</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 소아마비(폴리오)</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 다음 중 어린 시절 접종 받았던 백신을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="checkbox-wrap n4">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> BCG</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 백일해</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 홍역</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 풍진</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 디프테리아</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 파상풍</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 소아마비(폴리오)</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">반려 동물</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 현재 반려동물을 기르고 있습니까?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 현재 기르고 있는 반려 동물을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="checkbox-wrap n4">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 개</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 고양이</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 설치류</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 새</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 물고기</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 기타 <input type="text" name="" id="" class="form-item w-80p text-center"></label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-2. 현재 기르고 있는 반려 동물과 함께 한 기간을 적어주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="form-group n4">
                    <div>개 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>고양이 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>설치류 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>새 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>물고기 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>기타 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 어린 시절 반려동물을 기른 적이 있습니까?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 어린 시절 길렀던 반려 동물을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="checkbox-wrap n4">
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 개</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 고양이</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 설치류</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 새</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 물고기</label></div>
                    <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 기타 <input type="text" name="" id="" class="form-item w-80p text-center"></label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                2-2. 어린 시절 길렀던 반려 동물과 함께 한 기간을 적어주세요.
            </th>
            <td colspan="2" class="text-left">
                <div class="form-group n4">
                    <div>개 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>고양이 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>설치류 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>새 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>물고기 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                    <div>기타 : <input type="text" name="" id="" class="form-item small text-center"> 개월</div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">동거 가족 및 거주</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 동거 가족이 4인을 초과한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 영유아기(0~6세)에 조부모와 동거한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예 <input type="text" name="" id="" class="form-item small text-center"> 개월</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 영유아기(0~6세)에 조부모가 1년 이상 나를 키워주셨나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                4. 염증성 장질환을 가진 환자와 현재 동거 중 인가요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                4-1. 염증성 장질환 환자와 동거 중인 경우 동거 기간은 어떻게 되나요?
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 개월
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                5. 나의 출생지는 어디인가요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 대도시 (인구 50만명 이상)</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 중·소도시</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 농촌, 도서지역</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">진단 전 수술 병력</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 진단 전에 충수돌기 절제술(맹장 수술)을 받은 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 충수돌기 절제술 받은 시기와 염증성장질환 진단 시점의 차이가 얼마나 됩니까?
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 개월
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 진단 전에 편도선 절제술을 받은 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 편도선 절제술을 받은 시기와 염증성 장질환 진단 시점의 차이가 얼마나 됩니까?
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 개월
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">약제 사용력</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 어린 시절 항생제 치료를 1주 이상 지속한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 어린 시절 항생제 치료 기간은 얼마입니까? (최대)
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 개월
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 진단 시점 이전 항생제 치료를 1주 이상 지속한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 진단 시점 이전 항생제 치료 횟수는 얼마입니까?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 1-3회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 4-5회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 6회 이상</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 비스테로이드성 소염 진통제를 주 1회 이상 복용한다.
                <a href="#n" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                                                            아스피린, 부루펜, 이지엔6 등 모든 소염 진통제
                                                        </span>
                </a>
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">수면</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. 하루 평균 수면 시간은 어느 정도인가요? (최근 일주일 평균)
            </th>
            <td colspan="2" class="text-left">
                <input type="text" name="" id="" class="form-item small text-center"> 시간
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 진단 시점 이전 항생제 치료를 1주 이상 지속한 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 3교대 이상</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 환경 인자 설문</caption>
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 20%;">
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">COVID 19 (코로나19 바이러스 감염증)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                1. COVID 19에 감염된 적이 있나요?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 아니요</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id="" checked> 예</label></div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. COVID 19에 감염되었다면 감염이 확인된 일자는 언제인가요? (확진일 기준)
            </th>
            <td colspan="2" class="text-left">
                <div class="form-group date">
                    <select name="" id="" class="form-item w-10p">
                        <option value="">년</option>
                    </select>
                    <select name="" id="" class="form-item w-10p">
                        <option value="">월</option>
                    </select>
                    <div class="checkbox-wrap inline ml-10">
                        <div><label class="checkbox-group"><input type="checkbox" name="" id=""> Unknown</label></div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. COVID 19 백신 접종 횟수는?
            </th>
            <td colspan="2" class="text-left">
                <div class="radio-wrap n4">
                    <div><label class="radio-group"><input type="radio" name="" id=""> 미접종</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 1회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 2회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 3회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 4회</label></div>
                    <div><label class="radio-group"><input type="radio" name="" id=""> 5회 이상</label></div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>

    </script>
@endpush