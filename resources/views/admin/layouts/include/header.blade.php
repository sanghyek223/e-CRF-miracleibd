<header id="header">
    <div class="util-wrap text-right inner-layer">
        <p class="user-state">
            [{{ thisUser()->hospitalName() }}] {{ thisUser()->name_kr }} 님 최근 방문일 : {{ thisUser()->login_at->locale('ko')->isoFormat('YYYY-MM-DD A hh:mm:ss') }}
        </p>

        <p>
            로그인 유지시간: <span id="session-timer"></span>
        </p>

        <ul class="util-menu">
            <li class="on"><a href="javascript:loginExtension();" id="extend-session">연장</a></li>
            <li><a href="javascript:logout();">로그아웃</a></li>
        </ul>
    </div>

    <div class="header-wrap inner-layer">
        <h1 class="header-logo">
            <a href="{{ env('APP_URL') }}">
                마이크로바이옴 레지스트리
                <span>Microbiome Registry</span>
            </a>
        </h1>

        <nav id="gnb">
            <ul class="gnb-menu">
                @foreach($menu['main'] as $key => $val)
                    @continue($val['continue'])
                    @continue($val['dev'] && !isDev())
                    <li @class(['on' => $key === ($main_key ?? '')])>
                        <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" @if($val['blank']) target="_blank" @endif>
                            {{ $val['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>