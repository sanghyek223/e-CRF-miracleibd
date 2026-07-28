<div class="paging-wrap">
    <span class="count full-left"><b class="text-red">{{ $paginator->currentPage() }}</b> of {{ $paginator->lastPage() }}</span>

    <ul class="paging">
        @if (!$paginator->onFirstPage() /* 처음 */)
            <li class="first">
                <a href="{{ $paginator->url(1) }}">
                    <img src="/assets/image/icon/ic_first.png" alt="처음">
                </a>
            </li>
        @endif

        @if (!$paginator->onFirstPage() /* 이전 */)
            <li class="prev">
                <a href="{{ $paginator->previousPageUrl() }}">
                    <img src="/assets/image/icon/ic_prev.png" alt="이전">
                </a>
            </li>
        @endif

        @foreach ($elements as $element /* 페이지 번호 */)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="num {{ $page == $paginator->currentPage() ? 'on' : '' }}">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages() /* 다음 */)
            <li class="next">
                <a href="{{ $paginator->nextPageUrl() }}">
                    <img src="/assets/image/icon/ic_next.png" alt="다음">
                </a>
            </li>
        @endif

        @if ($paginator->hasMorePages() /* 마지막 */)
            <li class="last">
                <a href="{{ $paginator->url($paginator->lastPage()) }}">
                    <img src="/assets/image/icon/ic_last.png" alt="마지막">
                </a>
            </li>
        @endif
    </ul>
</div>