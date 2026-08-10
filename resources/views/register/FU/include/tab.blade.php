<div class="sub-tab-wrap sticky">
    <div class="sub-tab-cont-bg">
        <ul class="sub-tab-menu col5">
            @foreach($registerConfig['type'] as $key => $val)
                <li class="{{ $patient->getRegStatusClass($key) }} {{ $type === $key ? 'on' : '' }}">
                    <a href="{{ route($val['route'], ['tab' => array_key_first($registerConfig['tab'][$key]), 'regist_num' => $patient->regist_num]) }}">{{ $val['name'] }}</a>
                </li>
            @endforeach
        </ul>

        @if($tab !== 'LIST')
            <ul class="con-menu">
                @foreach($FU_sub_tabs as $key => $val)
                    <li @class(['on' => ($tab === $key)])>
                        <a href="{{ route("register.FU.upsert", ['tab' => $key, 'regist_num' => $patient->regist_num, 'FU_sid' => $Fu->sid]) }}">
                            <span class="state {{ $Fu->getRegStatusClass($key) }}"><b class="mark"></b></span> {{ $val }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @if($tab !== 'LIST')
        <div id="left-menu" class="left-side-menu">
            <ul class="left-menu-list js-left-menu">
                @foreach($FuList as $row)
                    <li @class(['on' => $row->sid === $Fu->sid])>
                        <a href="{{ route("register.FU.upsert", ['tab' => $tab, 'regist_num' => $patient->regist_num, 'FU_sid' => $row->sid]) }}">
                            {{ $row->FU_visit_d ?? '' }} <span class="state {{ $row->getRegStatusClass($tab) }}"><b class="mark"></b></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>