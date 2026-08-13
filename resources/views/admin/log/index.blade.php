@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents inner-layer">
        @include('admin.layouts.include.sub-tit-wrap')

        <div class="log-state-wrap">
            <div class="item type1">
                <p class="tit">전체 신청</p>
                <div class="count">{{ $list->total() }}</div>
            </div>

            @foreach($dataConfig['confirm'] as $key => $val)
                <div class="item type{{ $loop->iteration + 1 }}">
                    <p class="tit">{{ $val }}</p>
                    <div class="count">{{ number_format($confirm_counts[$key] ?? 0) }}</div>
                </div>
            @endforeach
        </div>

        <div class="sch-wrap">
            <form id="sch-frm">
                <fieldset>
                    <legend class="hide">데이터 신청/승인 로그 검색</legend>

                    <div class="form-group date">
                        <span class="text">신청일 :</span>
                        <x-input.text field="created_at_s" :data="request()?->created_at_s" class="form-item line short text-center" readonly/>
                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_s">

                        <span>~</span>

                        <x-input.text field="created_at_e" :data="request()?->created_at_e" class="form-item line short text-center" readonly/>
                        <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_e">
                    </div>

                    <div class="form-group">
                        <span class="text">신청 기관 :</span>
                        <select name="org_code" id="org_code" class="form-item sch-cate">
                            <option value="">전체 기관</option>
                            @foreach($hospitals as $row)
                                <option value="{{ $row->org_code }}" {{ request()->input('org_code', '') == $row->org_code ? 'selected' : '' }}>
                                    {{ $row->org_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <span class="text">제공 기관 :</span>
                        <select name="application_org_code" id="application_org_code" class="form-item sch-cate">
                            <option value="">전체 기관</option>
                            @foreach($hospitals as $row)
                                <option value="{{ $row->org_code }}" {{ request()->input('application_org_code', '') == $row->org_code ? 'selected' : '' }}>
                                    {{ $row->org_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <span class="text">상태 :</span>
                        <select name="confirm" id="confirm" class="form-item sch-cate state">
                            <option value="">전체</option>
                            @foreach($dataConfig['confirm'] as $key => $val)
                                <option value="{{ $key }}" {{ request()->input('confirm', '') == $key ? 'selected' : '' }}>
                                    {{ $val }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <x-input.text field="applicant" :data="request()?->applicant" class="form-item text-center" placeholder="신청자명 검색"/>
                    </div>

                    <button type="submit" class="btn btn-sch">검색</button>
                    <a href="{{ route('log') }}" class="btn btn-reset"><img src="/assets/image/icon/ic_reset.png" alt=""> 검색초기화</a>
                </fieldset>
            </form>
        </div>

        <div class="write-form-wrap mt-40">
            <div class="table-wrap">
                <table class="cst-table type-regist mypage-tbl">
                    <caption class="hide">목록</caption>
                    <colgroup>
                        <col style="width:6%">
                        <col style="width:10%">
                        <col style="width:10%">
                        <col style="width:8%">
                        <col style="width:8%">
                        <col style="width:16%;">
                        <col style="width:10%">
                        <col style="width:8%;">
                        <col>
                        <col style="width:8%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">신청 기관<br>(신청자)</th>
                        <th scope="col">제공 기관<br>(승인자)</th>
                        <th scope="col">신청일시</th>
                        <th scope="col">처리일시</th>
                        <th scope="col">데이터 범위<br>(다운로드 가능기간)</th>
                        <th scope="col">상태</th>
                        <th scope="col">다운로드 여부</th>
                        <th scope="col">반려 사유</th>
                        <th scope="col">상세</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($list as $row)
                        <tr>
                            <td>{{ number_format($row->seq) }}</td>
                            <td>
                                {{ $row->getHosName() }}
                                <br>({{ $row->applicant }})
                            </td>
                            <td>
                                {{ $row->getApplicationHosName() }}
                                <br>({{ $row->getApplicationUserName() }})
                            </td>
                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->confirm_at ?? '' }}</td>
                            <td>
                                {{ $row->getDataScope() }}
                                @if($row->confirmComplete())
                                    <br>
                                    ({{ $row->getDownloadDate() }})
                                @endif
                            </td>
                            <td>
                                <span class="state {{ $row->getConfirmClass() }}">{{ $row->getConfirm() }}</span>
                            </td>
                            <td>
                                @if($row->confirmReady())
                                    -
                                @else
                                    <strong class="{{ $row->isDownloadClass() }}">{{ $row->isDownload() }}</strong>
                                @endif
                            </td>
                            <td>
                                @if($row->confirmReject())
                                    {{ $row->reject_reason ?? '' }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-wrap">
                                    <a href="{{ route('log.detail', ['sid' => $row->sid]) }}" class="btn btn-small color-type5 call-popup" data-name="log-detail" data-width="700" data-height="750" title="보기">
                                        보기
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">신청 내역이 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $list->links('pagination::custom') }}
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('log.data') }}';
    </script>
@endsection