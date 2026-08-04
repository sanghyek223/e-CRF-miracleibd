<div class="sub-tab-wrap sticky">
    <div class="sub-tab-cont-bg">
        <ul class="sub-tab-menu col5">
            @foreach($registerConfig['type'] as $key => $val)
                <li class="{{ $patient->getRegStatusClass($key) }} {{ $type === $key ? 'on' : '' }}">
                    <a href="{{ route('register.upsert', ['type' => $key, 'tab' => $val['first_tab'], 'regist_num' => $regist_num]) }}">{{ $val['name'] }}</a>
                </li>
            @endforeach
        </ul>

        @if($sub_tab_show)
            <ul class="con-menu">
                @foreach($registerConfig['tab'][$type] as $key => $val)
                    <li @class(['on' => ($tab === $key)])>
                        <a href="{{ route('register.upsert', ['type' => $type, 'tab' => $key, 'regist_num' => $regist_num]) }}">
                            <span class="state {{ $patient->getRegTabStatusClass($type, $key) }}"><b class="mark"></b></span> {{ $val }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>