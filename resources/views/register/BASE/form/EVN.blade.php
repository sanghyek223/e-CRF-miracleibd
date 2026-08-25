@php
    $evnConfig = $registerConfig['BASE']['EVN'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
    $disabled_survey_d = (!$register->is_survey_y || $register->is_survey_uk); // 설문지 작성일자 text box disabled 유무
@endphp

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
            <th scope="row">설문 진행 유무</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_survey" value="{{ $key }}" :text="$val" :data="$register->b_EVN_survey"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">설문지 작성일자</th>
            <td class="text-left ESS-CHK">
                <div class="form-group date survey-date">
                    <x-input.text field="b_EVN_survey_d_y" :data="$register->b_EVN_survey_d_y" :disabled="$disabled_survey_d" class="form-item line small text-center dateY chk-active" maxlength="4" onlynumber/> /
                    <x-input.text field="b_EVN_survey_d_m" :data="$register->b_EVN_survey_d_m" :disabled="$disabled_survey_d" class="form-item line small text-center dateM chk-active" maxlength="2" onlynumber/> /
                    <x-input.text field="b_EVN_survey_d_d" :data="$register->b_EVN_survey_d_d" :disabled="$disabled_survey_d" class="form-item line small text-center dateD chk-active" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="b_EVN_survey_d" data-maxdate="{{ now()->format('Y-m-d') }}" style="display: {{ $disabled_survey_d ? 'none' : '' }}">

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_EVN_survey_d_uk" value="1" text="Unknown" :data="$register->b_EVN_survey_d_uk" :active="true" class="target-active ESS-CHK-NONE {{ !$register->is_survey_y ? 'NONE-CLICK' : '' }}"/>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <th scope="row">일상 활동 정도</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($evnConfig['b_EVN_E1q'] as $key => $val)
                        @if($key != '5')
                            <x-input.radio field="b_EVN_E1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_E1q" :active="true" class="target-active"/>
                        @else
                            <div class="inWrap">
                                <x-input.radio2 field="b_EVN_E1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_E1q" :active="false" class="target-active"/>
                                <x-input.text field="b_EVN_E1q_ow" :data="$register->b_EVN_E1q_ow" :disabled="!$register->is_E1q_etc" class="form-item xx-large chk-active"/>
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <th scope="row" colspan="2" class="text-left">1. 어릴 때 모유 수유를 하셨나요?</th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_B1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_B1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="B1q-tr" style="display: {{ $register->is_B1q ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">1-1. 모유 수유를 하였다면 기간은 어떻게 되나요?</th>
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_B1q_1" :data="$register->b_EVN_B1q_1" :disabled="!$register->is_B1q" class="form-item small text-center" onlynumber/> 개월
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">2. 어머니가 본인을 출산할 때 어떤 방법으로 하셨나요?</th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($evnConfig['b_EVN_B2q'] as $key => $val)
                        <x-input.radio field="b_EVN_B2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_B2q"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_PH1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_PH1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 다음 중 염증성장질환 진단 전 경험한 감염증을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="checkbox-wrap n4">
                    @foreach($evnConfig['b_EVN_PH2q'] as $key => $val)
                        <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 다음 중 어린 시절 접종 받았던 백신을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="checkbox-wrap n4">
                    @foreach($evnConfig['b_EVN_PH3q'] as $key => $val)
                        <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_P1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_P1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="P1q-tr" style="display: {{ $register->is_P1q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 현재 기르고 있는 반려 동물을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="checkbox-wrap n4">
                    @foreach($evnConfig['b_EVN_P1q'] as $key => $val)
                        @if($key != 'b_EVN_P1q6')
                            <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}" class="P1q-chk"/>
                        @else
                            <div class="target-box">
                                <x-input.checkbox2 field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}" :active2="false" class="target-box-active P1q-chk"/>
                                <x-input.text field="b_EVN_P1q_6_ow" :data="$register->b_EVN_P1q_6_ow" :disabled="empty($register->{$key})" class="form-item w-60p chk-active"/>
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="P1q-tr" style="display: {{ $register->is_P1q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                1-2. 현재 기르고 있는 반려 동물과 함께 한 기간을 적어주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="form-group n4">
                    @foreach($evnConfig['b_EVN_P1q'] as $key => $val)
                        <div>
                            {{ $val }} : <x-input.text field="{{ $key }}_p" :data="$register->{$key . '_p'}" :disabled="empty($register->{$key})" class="form-item small" onlynumber/> 개월
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left ESS-CHK">
                2. 어린 시절 반려동물을 기른 적이 있습니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_P2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_P2q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="P2q-tr" style="display: {{ $register->is_P2q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 어린 시절 길렀던 반려 동물을 <span class="underline">모두 선택해</span> 주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="checkbox-wrap n4">
                    @foreach($evnConfig['b_EVN_P2q'] as $key => $val)
                        @if($key != 'b_EVN_P2q6')
                            <x-input.checkbox field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}" class="P2q-chk"/>
                        @else
                            <div class="target-box">
                                <x-input.checkbox2 field="{{ $key }}" value="1" :text="$val" :data="$register->{$key}" :active2="false" class="target-box-active P2q-chk"/>
                                <x-input.text field="b_EVN_P2q_6_ow" :data="$register->b_EVN_P2q_6_ow" :disabled="empty($register->{$key})" class="form-item w-60p chk-active"/>
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="P2q-tr" style="display: {{ $register->is_P2q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                2-2. 어린 시절 길렀던 반려 동물과 함께 한 기간을 적어주세요.
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="form-group n4">
                    @foreach($evnConfig['b_EVN_P2q'] as $key => $val)
                        <div>
                            {{ $val }} : <x-input.text field="{{ $key }}_p" :data="$register->{$key . '_p'}" :disabled="empty($register->{$key})" class="form-item small" onlynumber/> 개월
                        </div>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_FH1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 영유아기(0~6세)에 조부모와 동거한 적이 있나요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_FH2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH2q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 영유아기(0~6세)에 조부모가 1년 이상 나를 키워주셨나요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        @if($key == '0')
                            <x-input.radio field="b_EVN_FH3q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH3q" :active="true" class="target-active"/>
                        @else
                            <div>
                                <x-input.radio2 field="b_EVN_FH3q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH3q" :active="false" class="target-active"/>
                                <x-input.text field="b_EVN_FH3q_1" :data="$register->b_EVN_FH3q_1" :disabled="!$register->is_FH3q_y" class="form-item small text-center chk-active" onlynumber/> 개월
                            </div>
                        @endif
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                4. 염증성 장질환을 가진 환자와 현재 동거 중 인가요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_FH4q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH4q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="FH4q-tr" style="display: {{ $register->b_EVN_FH4q ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                4-1. 염증성 장질환 환자와 동거 중인 경우 동거 기간은 어떻게 되나요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_FH4q_1" :data="$register->b_EVN_FH4q_1" class="form-item small text-center" onlynumber/> 개월
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                5. 나의 출생지는 어디인가요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($evnConfig['b_EVN_FH5q'] as $key => $val)
                        <x-input.radio field="b_EVN_FH5q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_FH5q"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_OP1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_OP1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="OP1q-tr" style="display: {{ $register->is_OP1q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 충수돌기 절제술 받은 시기와 염증성장질환 진단 시점의 차이가 얼마나 됩니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_OP1q_1" :data="$register->b_EVN_OP1q_1" class="form-item small text-center" onlynumber/> 개월
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 진단 전에 편도선 절제술을 받은 적이 있나요?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_OP2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_OP2q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="OP2q-tr" style="display: {{ $register->is_OP2q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 편도선 절제술을 받은 시기와 염증성 장질환 진단 시점의 차이가 얼마나 됩니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_OP2q_1" :data="$register->b_EVN_OP2q_1" class="form-item small text-center" onlynumber/> 개월
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_M1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_M1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="M1q-tr" style="display: {{ $register->is_M1q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. 어린 시절 항생제 치료 기간은 얼마입니까? (최대)
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_M1q_1" :data="$register->b_EVN_M1q_1" class="form-item small text-center" onlynumber/> 개월
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 현재 주·야간 교대 근무를 하고 있습니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_M2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_M2q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="M2q-tr" style="display: {{ $register->is_M2q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                2-1. 진단 시점 이전 항생제 치료 횟수는 얼마입니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($evnConfig['b_EVN_M2q_1'] as $key => $val)
                        <x-input.radio field="b_EVN_M2q_1" value="{{ $key }}" :text="$val" :data="$register->b_EVN_M2q_1"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                3. 비스테로이드성 소염 진통제를 주 1회 이상 복용한다.
                <a href="javascript:void(0);" class="tooltip">
                    <img src="/assets/image/icon/ic_tooltip.png" alt="information">
                    <span class="tooltip-con" style="opacity: 1; display: none;">
                        아스피린, 부루펜, 이지엔6 등 모든 소염 진통제
                    </span>
                </a>
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_M3q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_M3q"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <x-input.text field="b_EVN_S1q" :data="$register->b_EVN_S1q" class="form-item small text-center" onlynumber/> 시간
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. 현재 주·야간 교대 근무를 하고 있습니까?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($evnConfig['b_EVN_S2q'] as $key => $val)
                        <x-input.radio field="b_EVN_S2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_S2q"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="table-wrap survey-info-tbl" style="display: {{ $register->is_survey_y ? '' : 'none' }}">
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
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn2'] as $key => $val)
                        <x-input.radio field="b_EVN_C1q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_C1q"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="C1q-tr" style="display: {{ $register->is_C1q_y ? '' : 'none' }}">
            <th scope="row" colspan="2" class="text-left pl-30">
                1-1. COVID 19에 감염되었다면 감염이 확인된 일자는 언제인가요? (확진일 기준)
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="form-group date">
                    <select name="b_EVN_C1q_1_year" id="b_EVN_C1q_1_year" class="form-item w-10p chk-active" @if($register->is_C1q_1_uk) disabled @endif>
                        <option value="">년</option>
                        @for ($i = $registerConfig['year_end']; $i >= $registerConfig['year_start']; $i--)
                            <option value="{{ $i }}" {{ ($register->b_EVN_C1q_1_year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>

                    <select name="b_EVN_C1q_1_month" id="b_EVN_C1q_1_month" class="form-item w-10p chk-active" @if($register->is_C1q_1_uk) disabled @endif>
                        <option value="">월</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($register->b_EVN_C1q_1_month ?? '') == $i ? 'selected' : '' }}>{{ $i }}월</option>
                        @endfor
                    </select>

                    <div class="checkbox-wrap inline ml-10">
                        <x-input.checkbox field="b_EVN_C1q_1_uk" value="1" text="Unknown" :data="$register->b_EVN_C1q_1_uk" :active="true" class="target-active ESS-CHK-NONE"/>
                    </div>
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row" colspan="2" class="text-left">
                2. COVID 19 백신 접종 횟수는?
            </th>
            <td colspan="2" class="text-left ESS-CHK">
                <div class="radio-wrap n4">
                    @foreach($evnConfig['b_EVN_C2q'] as $key => $val)
                        <x-input.radio field="b_EVN_C2q" value="{{ $key }}" :text="$val" :data="$register->b_EVN_C2q"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('change', `${form} input[name=b_EVN_survey]`, function () {
            const value = $(form).find('input[name=b_EVN_survey]:checked').val() || '';
            const target = $(form).find('.survey-date');
            const target_text = target.find('input[type=text]');
            const target_checkbox = target.find('#b_EVN_survey_d_uk');
            const target_calendar = target.find('.target-replace-datepicker');
            const target_tbl = $(form).find('.survey-info-tbl');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_checkbox.removeClass('NONE-CLICK');
                target_calendar.show();
                target_tbl.show();
            } else {
                target_text.val('');
                target_calendar.hide();
                target_text.attr('disabled', true);
                target_checkbox.prop('checked', false);
                target_checkbox.addClass('NONE-CLICK');

                target_tbl.hide();
                target_tbl.find('input[type=text]').val('');
                target_tbl.find('input[type=radio]').prop('checked', false).trigger('change');
                target_tbl.find('input[type=checkbox]').prop('checked', false).trigger('change');
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_survey]`, function () {
            const value = $(form).find('input[name=b_EVN_survey]:checked').val() || '';
            const target = $(form).find('.survey-date');
            const target_text = target.find('input[type=text]');
            const target_checkbox = target.find('#b_EVN_survey_d_uk');
            const target_calendar = target.find('.target-replace-datepicker');

            if (value == '1') {
                target_text.removeAttr('disabled');
                target_checkbox.removeClass('NONE-CLICK');
                target_calendar.show();
            } else {
                target_text.val('');
                target_text.attr('disabled', true);

                target_checkbox.prop('checked', false);
                target_checkbox.addClass('NONE-CLICK');

                target_calendar.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_B1q]`, function () {
            const value = $(form).find('input[name=b_EVN_B1q]:checked').val() || '';
            const target = $(form).find('.B1q-tr');

            if (value == '1') {
                target.find('input[type=text]').removeAttr('disabled');
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.find('input[type=text]').attr('disabled', true);
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_P1q]`, function () {
            const value = $(form).find('input[name=b_EVN_P1q]:checked').val() || '';
            const target = $(form).find('.P1q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.find('input[type=text]').attr('disabled', true);
                target.find('input[type=checkbox]').prop('checked', false);
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_P2q]`, function () {
            const value = $(form).find('input[name=b_EVN_P2q]:checked').val() || '';
            const target = $(form).find('.P2q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.find('input[type=text]').attr('disabled', true);
                target.find('input[type=checkbox]').prop('checked', false);
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', '.P1q-chk, .P2q-chk', function () {
            const checked = $(this).is(':checked');
            const this_name = $(this).attr('name')
            const text_target = $(form).find(`#${this_name}_p`);

            if (checked) {
                text_target.removeAttr('disabled');
            } else {
                text_target.val('');
                text_target.attr('disabled', true);
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_FH4q]`, function () {
            const value = $(form).find('input[name=b_EVN_FH4q]:checked').val() || '';
            const target = $(form).find('.FH4q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_OP1q]`, function () {
            const value = $(form).find('input[name=b_EVN_OP1q]:checked').val() || '';
            const target = $(form).find('.OP1q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_OP2q]`, function () {
            const value = $(form).find('input[name=b_EVN_OP2q]:checked').val() || '';
            const target = $(form).find('.OP2q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_M1q]`, function () {
            const value = $(form).find('input[name=b_EVN_M1q]:checked').val() || '';
            const target = $(form).find('.M1q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_M2q]`, function () {
            const value = $(form).find('input[name=b_EVN_M2q]:checked').val() || '';
            const target = $(form).find('.M2q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('input[type=text]').val('');
                target.hide();
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_EVN_C1q]`, function () {
            const value = $(form).find('input[name=b_EVN_C1q]:checked').val() || '';
            const target = $(form).find('.C1q-tr');

            if (value == '1') {
                target.show();
            } else {
                target.find('#b_EVN_C1q_1_uk').prop('checked', false).trigger('change');
                target.hide();
            }

            validateEssChk();
        });
    </script>
@endpush