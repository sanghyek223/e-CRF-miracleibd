@extends('admin.layouts.admin-popup-layout')

@section('addStyle')
    <style>
        .contents {padding: 30px;}
    </style>
@endsection

@section('contents')
    <div class="popup-tit-wrap">
        <h3 class="popup-tit">데이터 신청 / 승인로그 상세보기</h3>
    </div>

    <div class="popup-conbox">
        <div class="write-form-wrap">
            <form id="log-detail-frm" method="post">
                <fieldset>
                    <legend class="hide">데이터 신청 / 승인 로그</legend>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-contit">신청기관</h4>
                    </div>

                    <div class="table-wrap">
                        <table class="cst-table">
                            <caption class="hide">신청기관</caption>
                            <colgroup>
                                <col style="width: 20%;">
                                <col>
                                <col style="width: 20%;">
                                <col>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="row">신청 기관</th>
                                <td colspan="3" class="text-left">{{ $application->getHosName() }}</td>
                            </tr>

                            <tr>
                                <th scope="row">신청 건수</th>
                                <td colspan="3" class="text-left">{{ number_format($application->dataSearchCount()) }}</td>
                            </tr>

                            <tr>
                                <th scope="row">신청자명</th>
                                <td colspan="3" class="text-left">{{ $application->applicant }}</td>
                            </tr>

                            <tr>
                                <th scope="row">신청 사유</th>
                                <td colspan="3" class="text-left">{{ $application->reason ?? '' }}</td>
                            </tr>

                            <tr>
                                <th scope="row">신청일시</th>
                                <td colspan="3" class="text-left">{{ $application->created_at }}</td>
                            </tr>

                            <tr>
                                <th scope="row">데이터 신청 범위</th>
                                <td colspan="3" class="text-left">
                                    <div class="radio-wrap form-disabled">
                                        @foreach($dataConfig['data_scope'] as $key => $val)
                                            <x-input.radio field="data_scope" :value="$key" :text="$val" :data="$application->data_scope" :disabled="true"/>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>

                            @if($application->download > 0)
                                <tr>
                                    <th scope="row">다운로드 수</th>
                                    <td colspan="3" class="text-left">{{ number_format($application->download) }}건</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="sub-tit-wrap">
                        <h4 class="sub-contit">승인기관</h4>
                    </div>

                    <div class="table-wrap">
                        <table class="cst-table">
                            <caption class="hide">승인기관</caption>
                            <colgroup>
                                <col style="width: 20%;">
                                <col>
                                <col style="width: 20%;">
                                <col>
                            </colgroup>

                            <tbody>
                            <tr>
                                <th scope="row">승인 기관</th>
                                <td colspan="3" class="text-left">{{ $application->getApplicationHosName() }}</td>
                            </tr>

                            <tr>
                                <th scope="row">승인자명</th>
                                <td colspan="3" class="text-left">
                                    @if(!$application->confirmReady())
                                        {{ $application->getApplicationUserName() }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">상태</th>
                                <td colspan="3" class="text-left {{ $application->confirmReject() ? 'text-red2' : '' }}">
                                    {{ $application->getConfirm() }}
                                </td>
                            </tr>

                            @if($application->confirmReject())
                                <tr>
                                    <th scope="row">반려 사유</th>
                                    <td colspan="3" class="text-left">
                                        {{ $application->reject_reason ?? '' }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <th scope="row">처리일시</th>
                                <td colspan="3" class="text-left">{{ $application->confirm_at ?? '' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="btn-wrap text-center">
                        <a href="javascript:self.close();" class="btn btn-type1 color-type3">확인</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#log-detail-frm';
        const dataUrl = '{{ route('log.data') }}';
    </script>
@endsection
