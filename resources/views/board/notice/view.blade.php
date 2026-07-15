@extends('layouts.web-layout')

@section('addStyle')
    <link href="/html/bbs/general/assets/css/board.css" rel="stylesheet">
    <link href="/assets/css/editor.css" rel="stylesheet">
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <!-- s:board -->
            @include('layouts.include.sub-tit-wrap')

            <div id="board" class="board-wrap">
                <div class="board-view">
                    <div class="view-contop">
                        <h4 class="view-tit">
                            @if($boardConfig['use']['category'])
                                <span class="bbs-cate">{{ $board->categoryTxt() }}</span>
                            @endif

                            <strong>{{ $board->subject }}</strong>
                        </h4>

                        <div class="view-info">
                            <span><strong>조회수 : </strong>{{ number_format($board->ref) }}</span>
                            <span><strong>게시일 : </strong>{{ $board->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>

                    @if($boardConfig['use']['link'] && !empty($board->link_url))
                        <div class="view-link text-right">
                            <a href="{{ $board->link_url }}" target="_blank">{{ $board->link_url }}</a>
                        </div>
                    @endif

                    <div class="view-contents editor-contents">
                        {!! $board->contents ?? '' !!}
                    </div>

                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)
                        <div class="view-attach">
                            <div class="view-attach-con">
                                <div class="con">
                                    @foreach($board->files as $file)
                                        <a href="{{ $file->downloadUrl() }}">
                                            {{ $file->filename }}  (다운로드 : {{ number_format($file->download) }}회)
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="btn-wrap text-center">
                        <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-board btn-list full-right">목록</a>

                        @if(!isMobile() && (isAdmin() || thisPk() == $board->u_sid))
                            <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-board btn-modify">수정</a>
                            <a href="javascript:void(0);" class="btn btn-board btn-delete board-btn-delete">삭제</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- //e:board -->
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.default-script")

    <script>
        @if(!isMobile() && (isAdmin() || thisPk() == $board->u_sid))

        $(document).on('click', '.board-btn-delete', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: 'board-delete', sid: {{ $board->sid }} });
            }
        });

        @endif
    </script>
@endsection
