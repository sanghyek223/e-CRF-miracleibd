@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form id="sch-frm">
                    <fieldset>
                        <legend class="hide">데이터 열람 / 신청</legend>

                        <div class="table-wrap">
                            <table class="cst-table">
                                <caption class="hide">데이터 열람 / 신청</caption>
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col>
                                    <col style="width: 20%;">
                                    <col>
                                </colgroup>

                                <tbody>
                                <tr>
                                    <th scope="row">
                                        기관
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="checkbox-wrap">
                                            @foreach($hospitals as $row)
                                                <x-input.checkbox3 id="org_code_{{ $row->sid }}" field="org_code" value="{{ $row->org_code }}" :text="$row->org_name" :checked="in_array($row->org_code, request()->input('org_code', []))"/>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        등록 날짜
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="form-group date">
                                            <x-input.text field="created_at_s" :data="request()->input('created_at_s', '')" class="form-item line short text-center"/>
                                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_s">

                                            <span>~</span>

                                            <x-input.text field="created_at_e" :data="request()->input('created_at_e', '')" class="form-item line short text-center"/>
                                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_e">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        성별
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="checkbox-wrap">
                                            @foreach($patientConfig['sex'] as $key => $val)
                                                <x-input.checkbox3 id="sex_{{ $key }}" field="sex" value="{{ $key }}" :text="$val" :checked="in_array($key, request()->input('sex', []))"/>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        진단시 나이
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="form-group date">
                                            만 <x-input.text field="IBD_age_s" :data="request()->input('IBD_age_s', '')" class="form-item line small text-center"/> 세
                                            <span class="text"> ~ </span>
                                            만 <x-input.text field="IBD_age_e" :data="request()->input('IBD_age_e', '')" class="form-item line small text-center"/> 세
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        IBD Type
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="checkbox-wrap">
                                            @foreach($registerConfig['BASE']['DX']['IBD_type'] as $key => $val)
                                                <x-input.checkbox3 id="IBD_type_{{ $key }}" field="IBD_type" value="{{ $key }}" :text="$val" :checked="in_array($key, request()->input('IBD_type', []))"/>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="btn-wrap text-center mt-20">
                            <button type="submit" class="btn btn-type1 color-type3">검색</button>
                            <a href="{{ route('data') }}" class="btn btn-type1 btn-line color-type3">검색 초기화</a>
                        </div>
                    </fieldset>
                </form>

                <form id="application-frm" method="post">
                    <fieldset>
                        <legend class="hide">타 기관 데이터 신청</legend>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">데이터 검색 결과</h4>
                            <p class="data-result-text">총 <strong class="result-count">{{ number_format($data->count()) }}</strong>건의 데이터가 검색되었습니다.</p>
                        </div>

                        <ul class="data-sch-result">
                            @foreach($hospitals as $row)
                                @php
                                    $groupCnt = $data->where('org_code', $row->org_code)->count();
                                    $noneData = ($groupCnt === 0);
                                @endphp
                                <li @class(['no-data' => $noneData])>
                                    <div class="name">
                                        <div class="checkbox-wrap text-center">
                                            <div>
                                                <label class="checkbox-group">
                                                    <input type="checkbox" name="" id="" @if($noneData) disabled @endif> {{ $row->org_name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="result">
                                        <strong>{{ number_format($groupCnt) }}</strong> 건
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="btn-wrap text-center mt-20">
                            <button type="submit" class="btn btn-type1 color-type2">타 기관 데이터 신청</button>
                        </div>
                    </fieldset>
                </form>

                <form id="backup-frm" method="post">
                    <fieldset>
                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">백업</h4>
                        </div>

                        <div class="table-wrap">
                            <table class="cst-table">
                                <caption class="hide">백업</caption>
                                <colgroup>
                                    <col style="width: 15%;">
                                    <col style="width: 20%;">
                                    <col>
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> ALL DATA</label></div>
                                        </div>
                                    </th>
                                    <th scope="col" colspan="2">입력폼</th>
                                    <th scope="col">건수</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th colspan="2" class="text-left">
                                        기본 정보
                                    </th>
                                    <td>
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="6" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th scope="row" rowspan="6" class="text-left">
                                        Baseline
                                    </th>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 진단 시점 정보</label></div>
                                        </div>
                                    </td>
                                    <td rowspan="6">
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 진단 시점 검사</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 진단 시점 영상</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 진단 시점 Lab</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 영양 치료</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 환경 인자 설문</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th colspan="2" class="text-left">
                                        Medication
                                    </th>
                                    <td>
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th colspan="2" class="text-left">
                                        Surgery
                                    </th>
                                    <td>
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th colspan="2" class="text-left">
                                        ER / Admission
                                    </th>
                                    <td>
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" rowspan="2" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th rowspan="2" class="text-left">
                                        End of Study (Last F/U)
                                    </th>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 마지막 내시경</label></div>
                                        </div>
                                    </td>
                                    <td rowspan="2">
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 마지막 F/U 시점의 약제 사용</label></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="btn-wrap text-center mt-20">
                            <a href="#n" class="btn btn-type1 color-type4">Excel 다운로드</a>
                        </div>

                        <div class="table-wrap mt-80">
                            <table class="cst-table">
                                <caption class="hide">백업</caption>
                                <colgroup>
                                    <col style="width: 15%;">
                                    <col style="width: 20%;">
                                    <col>
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> ALL DATA</label></div>
                                        </div>
                                    </th>
                                    <th scope="col" colspan="2">입력폼</th>
                                    <th scope="col">건수</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row" rowspan="4" class="bg-gray">
                                        <div class="checkbox-wrap text-center">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""></label></div>
                                        </div>
                                    </th>
                                    <th scope="row" rowspan="4" class="text-left">
                                        Follow-up
                                    </th>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 검체 정보</label></div>
                                        </div>
                                    </td>
                                    <td rowspan="4">
                                        000 건
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 검체 획득 시점 Lab</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 검체 획득 시점 검사</label></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="checkbox-wrap">
                                            <div><label class="checkbox-group"><input type="checkbox" name="" id=""> 검체 획득 시점 영상</label></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-wrap text-center mt-20 mb-80">
                            <a href="#n" class="btn btn-type1 color-type4">Excel 다운로드</a>
                        </div>

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
            </div>
        </div>
    </div>
@endsection

@section('addScript')
@endsection