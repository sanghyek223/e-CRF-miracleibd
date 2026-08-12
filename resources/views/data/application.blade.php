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
                <form id="application-frm" method="post" data-case="application-create">
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
                                    <th scope="row">신청 기관</th>
                                    <td colspan="3" class="text-left">{{ $hospital->org_name }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">신청 건수</th>
                                    <td colspan="3" class="text-left">{{ number_format($backup1_count) }} 건</td>
                                </tr>

                                @if($search_params['created_at_s'] || $search_params['created_at_e'])
                                    <tr>
                                        <th scope="row">{{ $dataConfig['search_params']['created_at'] }}</th>
                                        <td colspan="3" class="text-left ESS-CHK">
                                            @if($search_params['created_at_s'])
                                                {{ $search_params['created_at_s'] }}
                                            @endif

                                            @if($search_params['created_at_e'])
                                                ~ {{ $search_params['created_at_e'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if($search_params['sex'])
                                    <tr>
                                        <th scope="row">{{ $dataConfig['search_params']['sex'] }}</th>
                                        <td colspan="3" class="text-left ESS-CHK">
                                            @foreach($search_params['sex'] as $key => $val)
                                                {{ $patientConfig['sex'][$val] }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                @if($search_params['IBD_age_s'] || $search_params['IBD_age_e'])
                                    <tr>
                                        <th scope="row">{{ $dataConfig['search_params']['IBD_age'] }}</th>
                                        <td colspan="3" class="text-left ESS-CHK">
                                            @if($search_params['IBD_age_s'])
                                                {{ $search_params['IBD_age_s'] }}
                                            @endif

                                            @if($search_params['IBD_age_e'])
                                                ~ {{ $search_params['IBD_age_e'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif

                                @if($search_params['IBD_type'])
                                    <tr>
                                        <th scope="row">{{ $dataConfig['search_params']['IBD_type'] }}</th>
                                        <td colspan="3" class="text-left ESS-CHK">
                                            @foreach($search_params['IBD_type'] as $key => $val)
                                                {{ $registerConfig['BASE']['DX']['IBD_type'][$val] }}@if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <th scope="row">신청자명</th>
                                    <td colspan="3" class="text-left ESS-CHK">
                                        <x-input.text field="applicant" class="form-item medium text-center"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">신청 사유</th>
                                    <td colspan="3" class="text-left ESS-CHK">
                                        <x-other.textarea field="reason" class="form-item"/>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">데이터 다운로드 희망 날짜</th>
                                    <td colspan="3" class="text-left ESS-CHK">
                                        <div class="form-group date">
                                            <x-input.text field="download_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                                            <x-input.text field="download_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                                            <x-input.text field="download_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="download_d" data-mindate="{{ now()->format('Y-m-d') }}">
                                            <span class="text ml-20">(다운로드 가능 일자: YYYY/MM/DD ~ YYYY/MM/DD)</span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">데이터 신청 범위</th>
                                    <td colspan="3" class="text-left ESS-CHK">
                                        <div class="radio-wrap">
                                            @foreach($dataConfig['data_scope'] as $key => $val)
                                                <x-input.radio field="data_scope" value="{{ $key }}" :text="$val"/>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="sub-tit-wrap fastq-wrap" style="display: none;">
                            <h4 class="sub-contit">FASTQ 파일 선택</h4>
                        </div>
                        <div class="table-wrap fastq-wrap" style="display: none;">
                            <table class="cst-table" id="FASTQ-tbl">
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
                                            <x-input.checkbox id="FASTQ_all" field="FASTQ_all" value="Y" text="ALL DATA"/>
                                        </div>
                                    </th>
                                    <th scope="col">대상자 ID</th>
                                    <th scope="col">파일명</th>
                                    <th scope="col">용량</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($patientsFASTQ as $row)
                                    <tr>
                                        <td>
                                            <div class="checkbox-wrap text-center">
                                                <x-input.checkbox3 id="fastq_file{{ $loop->iteration }}" field="fastq_file" :value="$row->sid" class="fastq-chk"/>
                                            </div>
                                        </td>
                                        <td>{{ $row->regist_num }}</td>
                                        <td>{{ implode(', ', $row->FASTQ->getFileNameAll()) }}</td>
                                        <td>{{ formatBytes($row->FASTQ->getFileSizeSum()) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">FASTQ 정보가 없습니다.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="sub-tit-wrap row-data-wrap" style="display: none;">
                            <h4 class="sub-contit">Raw data 선택</h4>
                        </div>
                        <div class="table-wrap row-data-wrap" style="display: none;">
                            @include('data.include.backup1-tbl')
                        </div>

                        <div class="table-wrap row-data-wrap" style="display: none;">
                            @include('data.include.backup2-tbl')
                        </div>

                        <div class="btn-wrap text-center">
                            <a href="{{ url($search_url) }}" class="btn btn-type1 color-type1">취소</a>
                            <button type="submit" class="btn btn-type1 color-type2">데이터 신청</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = @json(route('data.data'));
        const form = '#application-frm';

        const application_org_code = @json($search_params['application_org_code']);
        const data_scope_file = @json($dataConfig['data_scope_file']);
        const data_scope_row = @json($dataConfig['data_scope_row']);

        $(function () {
            validateEssChk();
        });

        // 데이터 신청 범위 변경
        $(document).on('change', `${form} input[name=data_scope]`, function () {
            const data_scope_val = $(form).find('input[name=data_scope]:checked').val() || '';
            const fastq_wrap = $(form).find('.fastq-wrap');
            const row_data_wrap = $(form).find('.row-data-wrap');

            if (data_scope_file.includes(data_scope_val)) {
                fastq_wrap.show();
            } else {
                fastq_wrap.hide();
                fastq_wrap.find('input[type=checkbox]').prop('checked', false);
            }

            if (data_scope_row.includes(data_scope_val)) {
                row_data_wrap.show();
            } else {
                row_data_wrap.hide();
                row_data_wrap.find('input[type=checkbox]').prop('checked', false);
            }
        });

        $(document).on('submit', form, function () {
            const applicant = $(form).find('#applicant');
            if (isEmpty(applicant.val())) {
                alert('신청자명을 입력해주세요.');
                applicant.focus();
                return false;
            }

            const reason = $(form).find('#reason');
            if (isEmpty(reason.val())) {
                alert('신청 사유를 입력해주세요.');
                reason.focus();
                return false;
            }

            const download_d_y = $(form).find('#download_d_y');
            const download_d_m = $(form).find('#download_d_m');
            const download_d_d = $(form).find('#download_d_d');
            if (isEmpty(download_d_y.val()) || isEmpty(download_d_m.val()) || isEmpty(download_d_d.val())) {
                alert('데이터 다운로드 희망 날짜를 입력해주세요.');
                download_d_y.focus();
                return false;
            }

            const data_scope = $(form).find('input[name=data_scope]');
            const data_scope_val = $(form).find('input[name=data_scope]:checked').val();
            if (!data_scope.is(':checked')) {
                alert('데이터 신청범위를 선택해주세요.');
                data_scope.eq(0).focus();
                return false;
            }

            if (data_scope_file.includes(data_scope_val)) {
                const fastq_chk = $(form).find('.fastq-chk');
                if (!fastq_chk.is(':checked')) {
                    alert('FASTQ 기관을 선택해주세요.');
                    fastq_chk.eq(0).focus();
                    return false;
                }
            }

            if (data_scope_row.includes(data_scope_val)) {
                const row_chk = $(form).find('.backup-chk');
                if (!row_chk.is(':checked')) {
                    alert('Raw data 를 선택해주세요.');
                    row_chk.eq(0).focus();
                    return false;
                }
            }

            let ajaxData = newFormData(form);
            ajaxData.append('search_url', '{{ $search_url }}');
            ajaxData.append('search_params', JSON.stringify(@json($search_params)));

            callMultiAjax(dataUrl, ajaxData);
        });
    </script>
    @include('data.include.backup-tbl-script')
@endsection