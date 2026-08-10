<div class="sub-tab-wrap sticky">
    <div id="left-menu" class="left-side-menu">
        <ul class="left-menu-list js-left-menu type2">
            @foreach($menu['sub'][$main_key] as $key => $val)
                @if($val['continue']) @continue @endif
                @if($val['dev'] && !isDev()) @continue @endif
                <li @class(['on' => $key === ($sub_key ?? '')])>
                    <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}" @if($val['blank']) target="_blank" @endif>
                        {{ $val['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>