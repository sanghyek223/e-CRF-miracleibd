@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('layouts.include.sub-tit-wrap')

        <div class="sch-wrap">
            <form id="sch-frm">
                <fieldset>
                    <legend class="hide"></legend>

                    <div class="form-group">
                        <span class="text">기관 :</span>
                        <select name="org_code" id="org_code" class="form-item sch-cate">
                            @if(isAdmin())
                                <option value="">전체 기관</option>
                            @endif

                            @foreach($hospitals as $row)
                                <option value="{{ $row->org_code }}" {{ request()->input('org_code', '') == $row->org_code ? 'selected' : '' }}>
                                    {{ $row->org_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <span class="text">Registration No :</span>
                        <input type="text" name="regist_num" id="regist_num" class="form-item" value="{{ request()->input('regist_num', '') }}">
                    </div>

                    <button type="submit" class="btn btn-sch">검색</button>
                    <a href="{{ route('register') }}" class="btn btn-reset"><img src="/assets/image/icon/ic_reset.png" alt=""> 검색초기화</a>
                </fieldset>
            </form>
        </div>

        <p class="info-text text-right">
            * <span class="btn btn-reset"><img src="/assets/image/icon/ic_reset.png" alt=""> 검색초기화</span>
            버튼을 클릭하면 전체 리스트를 보실 수 있습니다.
        </p>

        <div class="table-contop">
            <div>
                @foreach($registerConfig['status'] as $key => $val)
                    <span class="state {{ $val['class'] }}"><b class="mark"></b> {{ $val['name'] }}</span>
                @endforeach
            </div>

            @include('components.list-all-count-box', ['target_name' => '환자가'])
        </div>

        <div class="write-form-wrap">
            <div class="table-wrap">
                <table class="cst-table type-regist">
                    <caption class="hide">목록</caption>
                    <colgroup>
                        <col style="width:12%">
                        <col style="width:8%">
                        <col>
                        <col style="width:6%">
                        <col style="width:6%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:8%;">
                        <col style="width:8%;">
                        <col style="width:8%;">
                        <col style="width:8%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">Registration No.</th>
                        <th scope="col">Initial</th>
                        <th scope="col">기관</th>
                        <th scope="col">성별/나이</th>
                        <th scope="col">IBD Type</th>

                        @foreach($registerConfig['type'] as $key => $val)
                            <th scope="col">{!! $val['thead'] !!}</th>
                        @endforeach

                        <th scope="col">대상자 관리<br>(수정/삭제)</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($list as $row)
                        @php
                            $BaseDX = $row->BaseDX;
                        @endphp
                        <tr data-sid="{{ enCryptString($row->sid) }}" data-num="{{ $row->regist_num }}">
                            <td>{{ $row->regist_num }}</td>
                            <td>{{ $row->initial ?? '' }}</td>
                            <td>{{ $row->org_name ?? '' }}</td>
                            <td>{{ $row->getSex() ?? '' }} / {{ $row->age ?? '' }}</td>
                            <td>{{ $BaseDX->getIBD() }}</td>

                            @foreach($registerConfig['type'] as $key => $val)
                                <td>
                                    <a href="{{ route('register.upsert', ['type' => $key, 'tab' => $val['first_tab'], 'regist_num' => $row->regist_num]) }}" class="btn btn-view" title="이동">VIEW</a>
                                    <span class="state {{ $row->getRegStatusClass($key) }}"><b class="mark"></b></span>
                                </td>
                            @endforeach

                            <td>
                                <div class="btn-wrap">
                                    <a href="{{ route('patient.upsert', ['regist_num' => $row->regist_num]) }}" class="btn btn-modity" title="수정"><img src="/assets/image/icon/icon_edit.png" alt="수정"></a>
                                    <a href="javascript:void(0);" class="btn btn-del" title="삭제"><img src="/assets/image/icon/ic_delete.png" alt="삭제"></a>
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
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('register.data') }}';

        $(document).on('click', '.btn-del', function () {
            const sid = $(this).closest('tr').data('sid');
            const num = $(this).closest('tr').data('num');

            if (confirm(`${num} 대상자를 삭제 하시겠습니까?`)) {
                callAjax(dataUrl, {
                    case: 'patient-delete',
                    sid: sid,
                    num: num,
                });
            }
        });
    </script>
@endsection