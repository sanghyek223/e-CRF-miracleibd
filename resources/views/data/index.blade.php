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

                <form id="application-frm" action="{{ route('data.application') }}" method="post">
                    <fieldset>
                        <legend class="hide">데이터 열람 / 신청</legend>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">데이터 검색 결과</h4>
                            <p class="data-result-text">총 <strong class="result-count">{{ number_format($data->count()) }}</strong>건의 데이터가 검색되었습니다.</p>
                        </div>

                        <ul class="data-sch-result">
                            @foreach($hospitals as $row)
                                @php
                                    $groupCnt = $data[$row->org_code]->total ?? 0;
                                    $noneData = ($groupCnt === 0);
                                @endphp
                                <li @class(['no-data' => $noneData, 'NONE-CLICK' => $noneData])>
                                    <div class="name">
                                        <div class="radio-wrap text-center">
                                            <x-input.radio id="application_org_code_{{ $loop->iteration }}" field="application_org_code" value="{{ $row->org_code }}" :text="$row->org_name" class="application-org-code"/>
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
                        <legend class="hide">데이터 열람 / 신청</legend>

                        <div class="sub-tit-wrap">
                            <h4 class="sub-contit">백업</h4>
                        </div>

                        <div class="table-wrap">
                            @include('data.include.backup1-tbl')
                        </div>
                        <div class="btn-wrap text-center mt-20">
                            <a href="javascript:void(0);" class="btn btn-type1 color-type4">Excel 다운로드</a>
                        </div>

                        <div class="table-wrap mt-80">
                            @include('data.include.backup2-tbl')
                        </div>
                        <div class="btn-wrap text-center mt-20 mb-80">
                            <a href="javascript:void(0);" class="btn btn-type1 color-type4">Excel 다운로드</a>
                        </div>
                    </fieldset>
                </form>
                
                @include('data.include.download-frm')
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = @json(route('data.data'));
        const schForm = '#sch-frm';
        const backupForm = '#backup-frm';
        const applicationForm = '#application-frm';

        /* 타기관 데이터 신청 */
        window.onload = function () {
            $(applicationForm).removeAttr('onsubmit');
        }

        $(document).on('submit', applicationForm, function () {
            const _this = $(applicationForm);
            const target = _this.find('.application-org-code');
            const checked = target.is(':checked');

            if (!checked) {
                alert('타 기관을 선택해주세요.');
                target.eq(0).focus();
                return false;
            }

            _this.append(
                $('<input>').attr({
                    type: 'hidden',
                    name: '_token',
                    value: $('meta[name="csrf-token"]').attr('content')
                })
            );

            _this.append(
                $('<input>').attr({
                    type: 'hidden',
                    name: 'search_url',
                    value: window.location.href
                })
            );
        });

        /* 백업 */
        // Backup1 ALL DATA
        const backup1AllCheck = () => {
            const target = $('#backup1-tbl').find('#backup1_all');
            const allLength = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all').length;
            const checkedLength = $('#backup1-tbl').find('input[type=checkbox]:checked').not('#backup1_all').length;

            target.prop('checked', (allLength === checkedLength));
        }

        $(document).on('change', `${backupForm} #backup1_all`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('input[type=checkbox]').not('#backup1_all');

            target.prop('checked', checked);
        });

        // Baseline
        $(document).on('change', `${backupForm} #backup1-tbl #backup1_BASE`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('.backup1-BASE');

            target.prop('checked', checked);
            backup1AllCheck();
        });

        $(document).on('change', `${backupForm} #backup1-tbl .backup1-BASE`, function () {
            const target = $('#backup1-tbl').find('#backup1_BASE');
            const allLength = $('#backup1-tbl').find('.backup1-BASE').length;
            const checkedLength = $('#backup1-tbl').find('.backup1-BASE:checked').length;

            target.prop('checked', (allLength === checkedLength));
            backup1AllCheck();
        });

        // End of Study (Last F/U)
        $(document).on('change', `${backupForm} #backup1-tbl #backup1_END`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup1-tbl').find('.backup1-END');

            target.prop('checked', checked);
            backup1AllCheck();
        });

        $(document).on('change', `${backupForm} #backup1-tbl .backup1-END`, function () {
            const target = $('#backup1-tbl').find('#backup1_END');
            const allLength = $('#backup1-tbl').find('.backup1-END').length;
            const checkedLength = $('#backup1-tbl').find('.backup1-END:checked').length;

            target.prop('checked', (allLength === checkedLength));
            backup1AllCheck();
        });

        // Backup2 ALL DATA
        const backup2AllCheck = () => {
            const target = $('#backup2-tbl').find('#backup2_all');
            const allLength = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all').length;
            const checkedLength = $('#backup2-tbl').find('input[type=checkbox]:checked').not('#backup2_all').length;

            target.prop('checked', (allLength === checkedLength));
        }

        $(document).on('change', `${backupForm} #backup2_all`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup2-tbl').find('input[type=checkbox]').not('#backup2_all');

            target.prop('checked', checked);
        });

        // Follow-up
        $(document).on('change', `${backupForm} #backup2-tbl #backup2_FU`, function () {
            const checked = $(this).is(':checked');
            const target = $('#backup2-tbl').find('.backup2-FU');

            target.prop('checked', checked);
            backup2AllCheck();
        });

        $(document).on('change', `${backupForm} #backup2-tbl .backup2-FU`, function () {
            const target = $('#backup2-tbl').find('#backup2_FU');
            const allLength = $('#backup2-tbl').find('.backup2-FU').length;
            const checkedLength = $('#backup2-tbl').find('.backup2-FU:checked').length;

            target.prop('checked', (allLength === checkedLength));
            backup2AllCheck();
        });
    </script>
    @stack('download-script')
@endsection