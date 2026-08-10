@php
    $bxConfig = $registerConfig['FU']['BX'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Follow-up | 검체 정보</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">검체 정보</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                대변 검체 획득일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="FU_feces_d_y" :data="$register->FU_feces_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_feces_d_m" :data="$register->FU_feces_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_feces_d_d" :data="$register->FU_feces_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_feces_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                혈액 검체 획득일
            </th>
            <td colspan="3" class="text-left">
                <div class="form-group date">
                    <x-input.text field="FU_bl_d_y" :data="$register->FU_bl_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_bl_d_m" :data="$register->FU_bl_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_bl_d_d" :data="$register->FU_bl_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_bl_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                조직 검체 획득일
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="FU_Bx_d_y" :data="$register->FU_Bx_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                    <x-input.text field="FU_Bx_d_m" :data="$register->FU_Bx_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                    <x-input.text field="FU_Bx_d_d" :data="$register->FU_Bx_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_Bx_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>
        </tr>

        <tr>
            <th colspan="4" scope="col" class="active">조직 검체 상세 정보</th>
        </tr>
        <tr>
            <th scope="row">
                취득 검체 개수
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group">
                    정상 부위 : <x-input.text field="FU_acq_norm_cnt" :data="$register->FU_acq_norm_cnt" class="form-item line small text-center" onlynumber/> 개,
                    병변 부위 : <x-input.text field="FU_acq_lesn_cnt" :data="$register->FU_acq_lesn_cnt" class="form-item line small text-center" onlynumber/> 개
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                의뢰 검체 개수
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="form-group">
                    정상 부위 : <x-input.text field="FU_req_norm_cnt" :data="$register->FU_req_norm_cnt" class="form-item line small text-center" onlynumber/> 개,
                    병변 부위 : <x-input.text field="FU_req_lesn_cnt" :data="$register->FU_req_lesn_cnt" class="form-item line small text-center" onlynumber/> 개
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">
                조직 채취 부위
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="checkbox-wrap">
                    @foreach($bxConfig['FU_Bx_l'] as $key => $val)
                        <x-input.checkbox field="FU_Bx_l" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_l"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_1-tr" style="display: {{ $register->is_Bx_l_1 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">Rectum 병리 결과</th>
        </tr>
        <tr class="Bx_l_1-tr" style="display: {{ $register->is_Bx_l_1 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_rec'] as $key => $val)
                        <x-input.radio field="FU_Bx_rec" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_rec"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_1-tr" style="display: {{ $register->is_Bx_l_1 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_rec_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_rec_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_rec_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_rec_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_rec_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_rec_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_1-tr" style="display: {{ $register->is_Bx_l_1 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_rec_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_rec_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_rec_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_rec_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_rec_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_rec_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_2-tr" style="display: {{ $register->is_Bx_l_2 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">S colon 병리 결과</th>
        </tr>
        <tr class="Bx_l_2-tr" style="display: {{ $register->is_Bx_l_2 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_SC'] as $key => $val)
                        <x-input.radio field="FU_Bx_SC" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_SC"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_2-tr" style="display: {{ $register->is_Bx_l_2 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    <div class="radio-wrap">
                        @foreach($bxConfig['FU_Bx_SC_r1'] as $key => $val)
                            <x-input.radio field="FU_Bx_SC_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_SC_r1"/>
                        @endforeach
                    </div>
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_SC_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_SC_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_SC_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_2-tr" style="display: {{ $register->is_Bx_l_2 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_SC_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_SC_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_SC_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_SC_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_SC_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_SC_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_3-tr" style="display: {{ $register->is_Bx_l_3 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">D colon 병리 결과</th>
        </tr>
        <tr class="Bx_l_3-tr" style="display: {{ $register->is_Bx_l_3 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_DC'] as $key => $val)
                        <x-input.radio field="FU_Bx_DC" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_DC"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_3-tr" style="display: {{ $register->is_Bx_l_3 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_DC_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_DC_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_DC_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_DC_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_DC_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_DC_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_3-tr" style="display: {{ $register->is_Bx_l_3 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_DC_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_DC_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_DC_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_DC_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_DC_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_DC_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_4-tr" style="display: {{ $register->is_Bx_l_4 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">T colon 병리 결과</th>
        </tr>
        <tr class="Bx_l_4-tr" style="display: {{ $register->is_Bx_l_4 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TC'] as $key => $val)
                        <x-input.radio field="FU_Bx_TC" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TC"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_4-tr" style="display: {{ $register->is_Bx_l_4 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TC_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_TC_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TC_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TC_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_TC_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TC_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_4-tr" style="display: {{ $register->is_Bx_l_4 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_TC_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_TC_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TC_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TC_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_TC_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TC_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_5-tr" style="display: {{ $register->is_Bx_l_5 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">A colon 병리 결과</th>
        </tr>
        <tr class="Bx_l_5-tr" style="display: {{ $register->is_Bx_l_5 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_AC'] as $key => $val)
                        <x-input.radio field="FU_Bx_AC" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_AC"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_5-tr" style="display: {{ $register->is_Bx_l_5 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_AC_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_AC_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_AC_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_AC_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_AC_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_AC_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_5-tr" style="display: {{ $register->is_Bx_l_5 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_AC_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_AC_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_AC_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_AC_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_AC_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_AC_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_6-tr" style="display: {{ $register->is_Bx_l_6 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">Cecum 병리 결과</th>
        </tr>
        <tr class="Bx_l_6-tr" style="display: {{ $register->is_Bx_l_6 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_cec'] as $key => $val)
                        <x-input.radio field="FU_Bx_cec" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_cec"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_6-tr" style="display: {{ $register->is_Bx_l_6 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_cec_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_cec_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_cec_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_cec_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_cec_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_cec_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_6-tr" style="display: {{ $register->is_Bx_l_6 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_cec_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_cec_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_cec_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_cec_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_cec_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_cec_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_7-tr" style="display: {{ $register->is_Bx_l_7 ? '' : 'none' }}">
            <th colspan="4" scope="col" class="active">Terminal ileum 병리 결과</th>
        </tr>
        <tr class="Bx_l_7-tr" style="display: {{ $register->is_Bx_l_7 ? '' : 'none' }}">
            <th scope="row">
                염증 여부 (내시경)
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TI'] as $key => $val)
                        <x-input.radio field="FU_Bx_TI" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TI"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_7-tr" style="display: {{ $register->is_Bx_l_7 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 1
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TI_r1'] as $key => $val)
                        <x-input.radio field="FU_Bx_TI_r1" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TI_r1"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 2
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TI_r2'] as $key => $val)
                        <x-input.radio field="FU_Bx_TI_r2" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TI_r2"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="Bx_l_7-tr" style="display: {{ $register->is_Bx_l_7 ? '' : 'none' }}">
            <th scope="row">
                병리 결과 3
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap full">
                    @foreach($bxConfig['FU_Bx_TI_r3'] as $key => $val)
                        <x-input.radio field="FU_Bx_TI_r3" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TI_r3"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">
                병리 결과 4
            </th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($bxConfig['FU_Bx_TI_r4'] as $key => $val)
                        <x-input.radio field="FU_Bx_TI_r4" value="{{ $key }}" :text="$val" :data="$register->FU_Bx_TI_r4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        @if(!$register->is_uc && !$register->is_cd)
            @include('register.include.none-ibd')
        @else
            @if($register->is_uc)
                <tr>
                    <th scope="row">
                        MES (UC인 경우)
                    </th>
                    <td class="text-left ESS-CHK">
                        <select name="FU_MES" id="FU_MES" class="form-item w-60p">
                            <option value="">선택</option>
                            @for($i = 0; $i <= 3; $i++)
                                <option value="{{ $i }}" {{ ($register->FU_MES ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </td>

                    <th scope="row">
                        UCEIS (UC인 경우)
                    </th>
                    <td class="text-left ESS-CHK">
                        <select name="FU_UCEIS" id="FU_UCEIS" class="form-item w-60p">
                            <option value="">선택</option>
                            @for($i = 0; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ ($register->FU_UCEIS ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </td>
                </tr>
            @endif

            @if($register->is_cd)
                <tr>
                    <th scope="row">
                        SES-CD (CD인 경우)
                    </th>
                    <td class="nbdr text-left ESS-CHK">
                        <select name="FU_SES_CD" id="FU_SES_CD" class="form-item w-60p">
                            <option value="">선택</option>
                            @for($i = 0; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ ($register->FU_SES_CD ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </td>

                    <td colspan="2" class="nbdl"></td>
                </tr>
            @endif
        @endif
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

        $(document).on('change', 'input[name=FU_Bx_l]', function () {
            const value = $(this).val() || '';
            const checked = $(this).is(':checked');
            const target = $(`.Bx_l_${value}-tr`);

            if (checked) {
                target.show();
            } else {
                target.hide();
                target.find('input[type=radio]').prop('checked', false);
            }
        });
    </script>
@endpush