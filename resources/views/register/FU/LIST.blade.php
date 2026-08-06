@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        <div class="sub-tit-wrap">
            <h3 class="sub-tit">{{ $page_title }}</h3>
        </div>

        @include("register.include.info")

        @include("register.include.tab", ['sub_tab_show' => false])

        <div class="sch-wrap type2">
            <form id="Fu-frm" method="post">
                <fieldset>
                    <legend class="hide"></legend>

                    <div class="form-group">
                        <span class="text">IBD Type :</span>
                        <select name="IBD_type" id="IBD_type" class="form-item sch-cate">
                            @foreach($registerConfig['BASE']['DX']['IBD_type'] as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group date">
                        <div class="form-group date">
                            <x-input.text field="FU_visit_d_y" class="form-item line small text-center dateY" maxlength="4" onlynumber/> /
                            <x-input.text field="FU_visit_d_m" class="form-item line small text-center dateM" maxlength="2" onlynumber/> /
                            <x-input.text field="FU_visit_d_d" class="form-item line small text-center dateD" maxlength="2" onlynumber/>
                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker" data-target="FU_visit_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <button type="button" class="btn color-type2" id="Fu-create-btn">추적 등록</button>
                    <button type="button" class="btn color-type2" id="Fu-update-btn">추적 수정</button>
                    <a href="javascript:location.reload();" class="btn color-type1">취소</a>
                </fieldset>
            </form>
        </div>

        <div class="sub-conbox mt-40">
            <div class="write-form-wrap">
                <div class="table-wrap">
                    <table class="cst-table type-regist">
                        <caption class="hide">목록</caption>

                        <colgroup>
                            <col style="width:auto">
                            <col style="width:17%">
                            <col style="width:17%;">
                            <col style="width:17%;">
                            <col style="width:17%;">
                            <col style="width:12%;">
                        </colgroup>

                        <thead>
                        <tr>
                            <th scope="col">방문일</th>

                            @foreach($registerConfig['tab']['FU'] as $key => $val)
                                @if($key === 'LIST') @continue @endif
                                <th scope="col">{{ $val }}</th>
                            @endforeach

                            <th scope="col">관리<br>(수정/삭제)</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($list as $row)
                            <tr data-sid="{{ enCryptString($row->sid) }}">
                                <td>{{ $row->FU_visit_d ?? '' }}</td>

                                @foreach($registerConfig['tab']['FU'] as $key => $val)
                                    @if($key === 'LIST') @continue @endif
                                    <td>
                                        <a href="{{ route('register.upsert', ['type' => 'FU', 'tab' => $key, 'regist_num' => $patient->regist_num]) }}" class="btn btn-view" title="이동">VIEW</a>
                                        <span class="state {{ $row->getRegStatusClass($key) }}"><b class="mark"></b></span>
                                    </td>
                                @endforeach

                                <td>
                                    <div class="btn-wrap">
                                        <a href="javascript:void(0);" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                        <a href="javascript:void(0);" class="btn btn-del btn-del-confirm" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $list->links('pagination::custom') }}
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#Fu-frm';
        const dataUrl = @json(route('register.data', ['type' => $type, 'regist_num' => $patient->regist_num]));

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-modity', function () {
            callAjax(dataUrl, {
                'case': 'Fu-upsert',
                'sid': getPK(this),
            });
        });

        $(document).on('click', '.btn-del-confirm', function () {
            callAjax(dataUrl, {
                'case': 'Fu-delete-confirm',
                'sid': getPK(this),
            });
        });

        $(document).on('submit', '#Fu-delete-frm', function () {
            callAjax(dataUrl, formSerialize(this));
        });

        $(document).on('click', '#Fu-create-btn', function () {
            $(form).data('case', 'Fu-create');
            FuSubmit();
        });

        $(document).on('click', '#Fu-update-btn', function () {
            $(form).data('case', 'Fu-update');
            FuSubmit(true);
        });

        const FuSubmit = (update = false) => {
            const sid = $(form).data('sid');

            if (update) {
                if (isEmpty(sid)) {
                    alert('수정 대상이 없습니다.');
                    return false;
                }
            } else {
                if (!isEmpty(sid)) {
                    alert('수정중 입니다.');
                    return false;
                }
            }

            const IBD_type = $(form).find('#IBD_type');
            if (isEmpty(IBD_type.val())) {
                alert('IBD Type 을 선택해주세요.');
                return false;
            }

            const FU_visit_d_y = $(form).find('#FU_visit_d_y');
            if (isEmpty(FU_visit_d_y.val())) {
                alert('년도를 입력해주세요.');
                return false;
            }

            const FU_visit_d_m = $(form).find('#FU_visit_d_m');
            if (isEmpty(FU_visit_d_m.val())) {
                alert('월을 입력해주세요.');
                return false;
            }

            const FU_visit_d_d = $(form).find('#FU_visit_d_d');
            if (isEmpty(FU_visit_d_d.val())) {
                alert('일를 입력해주세요.');
                return false;
            }

            callAjax(dataUrl, formSerialize(form));
        }
    </script>
@endsection