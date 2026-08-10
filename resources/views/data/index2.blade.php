@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">타 기관 데이터 신청</h3>
            <p class="mt-10">본 데이터는 개인정보 보호를 위해 식별 가능한 개인정보를 제외한 데이터만 제공됩니다.</p>
        </div>

        <div class="sub-conbox">
            <div class="write-form-wrap">
                <form action="" method="">
                    <fieldset>
                        <legend class="hide">타 기관 데이터 신청</legend>

                        <div class="table-wrap">
                            <table class="cst-table">
                                <caption class="hide">타 기관 데이터 신청</caption>
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col>
                                    <col style="width: 20%;">
                                    <col>
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        신청 기관
                                    </th>
                                    <td colspan="3" class="text-left">
                                        B기관, C기관
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        신청 건수
                                    </th>
                                    <td colspan="3" class="text-left">
                                        1건, 3건 (총 4건)
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        신청자명
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <input type="text" name="" id="" class="form-item medium text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        신청 사유
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <textarea name="" id="" class="form-item"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        데이터 다운로드 희망 날짜
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="form-group date">
                                            <input type="text" name="" id="" class="form-item line small text-center"> /
                                            <input type="text" name="" id="" class="form-item line small text-center"> /
                                            <input type="text" name="" id="" class="form-item line small text-center">
                                            <img src="/assets/image/icon/ic_cal.png" alt="">
                                            <span cclass="text ml-20">(다운로드 가능 일자: YYYY/MM/DD ~ YYYY/MM/DD)</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        데이터 신청 범위
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="form-group date">
                                            만 <input type="text" name="" id="" class="form-item line small text-center"> 세
                                            <span class="text"> ~ </span>
                                            만 <input type="text" name="" id="" class="form-item line small text-center"> 세
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        IBD Type
                                    </th>
                                    <td colspan="3" class="text-left">
                                        <div class="radio-wrap">
                                            <div><label class="radio-group"><input type="radio" name="" id=""> FASTQ 파일</label></div>
                                            <div><label class="radio-group"><input type="radio" name="" id=""> raw data</label></div>
                                            <div><label class="radio-group"><input type="radio" name="" id=""> FASTQ 파일 + raw data</label></div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">FASTQ 파일 선택</h4>
                        </div>
                        <div class="table-wrap">
                            <table class="cst-table">
                                <caption class="hide">FASTQ 파일 선택</caption>
                                <colgroup>
                                    <col style="width:12%">
                                    <col style="width:24%">
                                    <col style="width:auto;">
                                    <col style="width:24%;">
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
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">Raw data 선택</h4>
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

                        <div class="table-wrap">
                            <table class="cst-table">
                                <caption class="hide">Raw data 선택</caption>
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


                        <div class="btn-wrap text-center">
                            <a href="#n" class="btn btn-type1 color-type1">취소</a>
                            <button type="submit" class="btn btn-type1 color-type2">데이터 신청</button>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
@endsection