<div class="sub-tab-wrap sticky">
    <div class="sub-tab-cont-bg">
        <ul class="sub-tab-menu col5">
            @foreach($registerConfig['type'] as $key => $val)
                <li class="{{ $patient->getRegStatusClass($key) }} {{ $type === $key ? 'on' : '' }}">
                    <a href="{{ route($val['route'], ['tab' => array_key_first($registerConfig['tab'][$key]), 'regist_num' => $patient->regist_num]) }}">{{ $val['name'] }}</a>
                </li>
            @endforeach
        </ul>

        @if($type !== 'FASTQ')
            <ul class="con-menu">
                @foreach($registerConfig['tab'][$type] as $key => $val)
                    <li @class(['on' => ($tab === $key)])>
                        <a href="{{ route("register.{$type}.upsert", ['tab' => $key, 'regist_num' => $patient->regist_num]) }}">
                            <span class="state {{ $patient->getRegTabStatusClass($type, $key) }}"><b class="mark"></b></span> {{ $val }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>