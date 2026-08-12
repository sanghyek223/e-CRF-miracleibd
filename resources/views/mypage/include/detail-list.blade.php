<div class="table-contop">
    <ul class="detail-list">
        <li>전체 신청: <strong class="text-blue">{{ $list->total() }}</strong> 건</li>
        @foreach($dataConfig['confirm'] as $key => $val)
            <li>
                {{ $val }}: <strong class="{{ $key == 'C' ? 'text-red2' : 'text-blue' }}">{{ number_format($confirm_counts[$key] ?? 0) }}</strong> 건
            </li>
        @endforeach
    </ul>
</div>