@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        @include('mypage.include.tab')

        <div class="contents-grid-wrap">
            <div class="left-side-blank"></div>
            <div class="sub-conbox">
                <div class="write-form-wrap">
                    @include('mypage.include.detail-list')

                    <div class="table-wrap">
                        <table class="cst-table type-regist mypage-tbl">
                            <caption class="hide">마이페이지 | 승인 내역</caption>
                            <colgroup>
                                <col style="width:auto">
                                <col style="width:12%">
                                <col style="width:15%;">
                                <col style="width:12%;">
                                <col style="width:18%;">
                                <col style="width:12%;">
                                <col style="width:12%;">
                            </colgroup>

                            <thead>
                            <tr>
                                <th scope="col">신청자(신청 기관)</th>
                                <th scope="col">신청일</th>
                                <th scope="col">데이터 범위</th>
                                <th scope="col">신청목록</th>
                                <th scope="col">요청 기간</th>
                                <th scope="col">상태</th>
                                <th scope="col">관리</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $row)
                                <tr data-sid="{{ enCryptString($row->sid) }}">
                                    <td>{{ $row->applicant }} ({{ $row->getHosName() }})</td>
                                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $row->getDataScope() }}</td>

                                    <td class="text-center">
                                        <div class="btn-wrap">
                                            <a href="{{ route('mypage.approval.detail', ['sid' => $row->sid]) }}" class="btn btn-small color-type5" title="상세보기">상세보기</a>
                                        </div>
                                    </td>

                                    <td>{{ $row->getDownloadDate() }}</td>

                                    <td>
                                        <span class="state {{ $row->getConfirmClass() }}">{{ $row->getConfirm() }}</span>
                                    </td>

                                    <td class="text-center">
                                        @switch($row->confirm)
                                            @case('N' /* 승인 대기 */)
                                                <div class="btn-wrap">
                                                    <a href="javascript:void(0);" class="btn btn-small color-type2 confirm-layer" title="관리" data-layer="select">신청 관리</a>
{{--                                                    <a href="javascript:void(0);" class="btn btn-small color-type2 confirm-layer" title="승인" data-layer="approve">승인</a>--}}
{{--                                                    <a href="javascript:void(0);" class="btn btn-small color-type6 confirm-layer" title="반려" data-layer="reject">반려</a>--}}
                                                </div>
                                                @break

                                            @case('R' /* 반려 */)
                                                <div class="btn-wrap">
                                                    <a href="javascript:void(0);" class="btn btn-small color-type1 reject-cancel">반려 취소</a>
                                                </div>
                                                @break

                                            @default
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">승인 내역이 없습니다.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $list->links('pagination::custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('mypage.data') }}';
        const confirmForm = '#confirm-frm';
        const approveForm = '#approval-approve-frm';
        const rejectForm = '#approval-reject-frm';

        $(document).on('click', '.confirm-layer', function () {
            const _this = $(this);

            callbackAjax(dataUrl, {
                'case': 'approval-confirm-layer',
                'layer': _this.data('layer'),
                'sid': _this.closest('tr').data('sid'),
            }, function (data, error) {
                if (error) {
                    ajaxErrorData(error);
                    return false;
                }

                ajaxSuccessData(data);
                callTargetDatePicker();
            });
        });

        $(document).on('click', '.reject-cancel', function () {
            const _this = $(this);

            if (confirm('반려 취소 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'approval-reject-cancel',
                    'sid': _this.closest('tr').data('sid'),
                });
            }
        });

        $(document).on('change', `${confirmForm} input[name=confirm]`, function () {
            const value = $(confirmForm).find('input[name=confirm]:checked').val() || '';
            console.log(value)
            const y_target = $(confirmForm).find('.confirm-y-box');
            const n_target = $(confirmForm).find('.confirm-n-box');

            switch (value) {
                case 'Y':
                    y_target.show();

                    n_target.hide();
                    n_target.find('textarea').val('');
                    break;

                case 'R':
                    n_target.show();
                    y_target.hide();
                    break;

                default:
                    y_target.hide();
                    n_target.hide();
                    n_target.find('textarea').val('');
                    break;
            }
        });

        $(document).on('submit', confirmForm, function () {
            const confirm = $(confirmForm).find('input[name=confirm]');
            const confirm_val = $(confirmForm).find('input[name=confirm]:checked').val();
            if (!confirm.is(':checked')) {
                alert('처리 상태를 선택해주세요.');
                confirm.eq(0).focus();
                return false;
            }

            if (confirm_val == 'Y') {

                const download_d_s = $(confirmForm).find('#download_d_s');
                if (isEmpty(download_d_s.val())) {
                    alert('다운로드 허용 기간(시작 일자)를 입력해주세요.');
                    download_d_s.focus();
                    return false;
                }

                const download_d_e = $(confirmForm).find('#download_d_e');
                if (isEmpty(download_d_e.val())) {
                    alert('다운로드 허용 기간(종료 일자)를 입력해주세요.');
                    download_d_e.focus();
                    return false;
                }
            }

            if (confirm_val == 'R') {

                const reject_reason = $(confirmForm).find('#reject_reason');
                if (isEmpty(reject_reason.val())) {
                    alert('반려 사유를 입력해주세요.');
                    reject_reason.focus();
                    return false;
                }
            }

            callAjax(dataUrl, formSerialize(confirmForm));
        });

        $(document).on('submit', approveForm, function () {
            const download_d_s = $(approveForm).find('#download_d_s');
            if (isEmpty(download_d_s.val())) {
                alert('다운로드 허용 기간(시작 일자)를 입력해주세요.');
                download_d_s.focus();
                return false;
            }

            const download_d_e = $(approveForm).find('#download_d_e');
            if (isEmpty(download_d_e.val())) {
                alert('다운로드 허용 기간(종료 일자)를 입력해주세요.');
                download_d_e.focus();
                return false;
            }

            callAjax(dataUrl, formSerialize(approveForm));
        });

        $(document).on('submit', rejectForm, function () {
            const reject_reason = $(rejectForm).find('#reject_reason');
            if (isEmpty(reject_reason.val())) {
                alert('반려 사유를 입력해주세요.');
                reject_reason.focus();
                return false;
            }

            callAjax(dataUrl, formSerialize(rejectForm));
        });
    </script>
@endsection