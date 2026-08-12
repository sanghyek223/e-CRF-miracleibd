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
                    <form action="" method="">
                        <fieldset>
                            <legend class="hide">마이페이지 | 승인 내역</legend>

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
                                        <th scope="col">신청일시</th>
                                        <th scope="col">데이터 범위</th>
                                        <th scope="col">신청목록</th>
                                        <th scope="col">요청 기간</th>
                                        <th scope="col">상태</th>
                                        <th scope="col">관리</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($list as $row)
                                        <tr>
                                            <td>{{ $row->user->name_kr }} ({{ $row->hospital->org_name }})</td>
                                            <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $row->getDataScope() }}</td>

                                            <td class="text-center">
                                                <div class="btn-wrap">
                                                    <a href="javascript:void(0);" class="btn btn-small color-type5" title="상세보기">상세보기</a>
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
                                                            <a href="javascript:void(0);" class="btn btn-small color-type2" title="승인">승인</a>
                                                            <a href="javascript:void(0);" class="btn btn-small color-type6" title="반려">반려</a>
                                                        </div>
                                                        @break

                                                    @case('C' /* 반려 */)
                                                        <div class="btn-wrap">
                                                            <a href="javascript:void(0);" class="btn btn-small color-type1">반려 취소</a>
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

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('mypage.data') }}';
    </script>
@endsection