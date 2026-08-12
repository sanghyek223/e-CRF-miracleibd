<div class="sub-tit-wrap">
    @empty($sub_key)
        <h3 class="sub-tit">{{ $menu['main'][$main_key]['name'] ?? '' }}</h3>
    @else
        <h3 class="sub-tit">{{ $menu['sub'][$main_key][$sub_key]['name'] ?? '' }}</h3>
    @endempty
</div>