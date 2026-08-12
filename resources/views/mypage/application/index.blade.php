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
                            <caption class="hide">마이페이지 | 신청 내역</caption>
                            <colgroup>
                                <col style="width:auto">
                                <col style="width:15%">
                                <col style="width:20%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                                <col style="width:15%;">
                            </colgroup>

                            <thead>
                            <tr>
                                <th scope="col">신청 기관</th>
                                <th scope="col">신청일</th>
                                <th scope="col">데이터 범위</th>
                                <th scope="col">신청 건수</th>
                                <th scope="col">진행 상태</th>
                                <th scope="col">다운로드/관리</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($list as $row)
                                <tr>
                                    <td>{{ $row->getApplicationHosName() }}</td>
                                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $row->getDataScope() }}</td>
                                    <td>{{ $row->dataSearchCount() }}</td>
                                    <td>
                                        <span class="state {{ $row->getConfirmClass() }}">{{ $row->getConfirm() }}</span>
                                    </td>
                                    <td class="text-center">
                                            <div class="btn-wrap">
                                                <a href="{{ route('mypage.application.download', ['sid' => $row->sid]) }}" class="btn btn-small color-type2" title="다운로드 상세">다운로드 상세</a>
                                            </div>

                                            <div class="mt-5">(기한: {{ $row->download_d_s->format('m.d') }}~{{ $row->download_d_e->format('m.d') }})</div>
                                        @if($row->confirmComplete())
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">신청 내역이 없습니다.</td>
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
    </script>
@endsection