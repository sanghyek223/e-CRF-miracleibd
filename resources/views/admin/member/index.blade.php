@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('admin.layouts.include.sub-tit-wrap')

        <div class="sch-wrap">
            <form id="sch-frm">
                <fieldset>
                    <legend class="hide">회원 관리</legend>

                    <div class="form-group">
                        <select name="org_code" id="org_code" class="form-item sch-cate">
                            <option value="">전체 기관</option>
                            @foreach($hospitals as $row)
                                <option value="{{ $row->org_code }}" {{ $row->org_code == request()->input('org_code', '') ? 'selected' : '' }}>{{ $row->org_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="search_key" id="search_key" class="form-item">
                            @foreach($userConfig['admin_search'] as $key => $val)
                                <option value="{{ $key }}" {{ request()->input('search_key', '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <x-input.text field="keyword" :data="request()->input('keyword', '')" class="form-item text-center"/>
                    </div>

                    <div class="form-group date">
                        <span class="text">등록일 :</span>

                        <x-input.text field="created_at_s" :data="request()->input('created_at_s', '')" class="form-item text-center"/>
                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_s">

                        <span>~</span>

                        <x-input.text field="created_at_e" :data="request()->input('created_at_e', '')" class="form-item text-center"/>
                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_e">
                    </div>

                    <button type="submit" class="btn btn-sch">검색</button>
                    <a href="{{ route('member') }}" class="btn btn-reset"><img src="/assets/image/icon/ic_reset.png" alt=""> 검색초기화</a>
                </fieldset>
            </form>
        </div>

        <div class="write-form-wrap mt-40">
            <div class="table-wrap">
                <table class="cst-table type-regist mypage-tbl">
                    <caption class="hide">목록</caption>
                    <colgroup>
                        <col style="width:8%">
                        <col style="width:14%">
                        <col style="width:14%">
                        <col>
                        <col style="width:14%;">
                        <col style="width:14%">
                        <col style="width:10%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">ID</th>
                        <th scope="col">이름</th>
                        <th scope="col">기관</th>
                        <th scope="col">등급</th>
                        <th scope="col">등록일</th>
                        <th scope="col">관리</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($list as $row)
                        <tr data-sid="{{ $row->sid }}">
                            <td>{{ number_format($row->seq) }}</td>
                            <td>{{ $row->uid }}</td>
                            <td>{{ $row->name_kr }}</td>
                            <td>{{ $row->hospitalName() }}</td>
                            <td>
                                <select class="form-item select-level">
                                    @foreach($userConfig['level'] as $key => $val)
                                        <option value="{{ $key }}" {{ $key === $row->level ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <div class="btn-wrap">
                                    <a href="{{ route('member.upsert', ['sid' => $row->sid]) }}" class="btn btn-modity call-popup" data-name="member-upsert" data-width="1200" data-height="400" title="수정">
                                        <img src="/assets/image/icon/icon_edit.png" alt="수정">
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-del member-delete" title="삭제">
                                        <img src="/assets/image/icon/ic_delete.png" alt="삭제">
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $list->links('pagination::custom') }}

            <div class="btn-wrap text-right mt-20">
                <a href="{{ route('member.upsert') }}" class="btn btn-type1 color-type2 call-popup" data-name="member-upsert" data-width="1200" data-height="400">
                    등록
                </a>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('member.data') }}';

        const getPK = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.member-delete', function () {
            const sid = getPK(this);

            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    case: 'user-delete',
                    sid: sid,
                });
            }
        });
    </script>
@endsection
