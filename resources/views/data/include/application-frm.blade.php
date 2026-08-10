<form id="application-frm" method="post">
    <fieldset>
        <legend class="hide">데이터 열람 / 신청</legend>

        <div class="sub-tit-wrap">
            <h4 class="sub-contit">데이터 검색 결과</h4>
            <p class="data-result-text">총 <strong class="result-count">{{ number_format($data->count()) }}</strong>건의 데이터가 검색되었습니다.</p>
        </div>

        <ul class="data-sch-result">
            @foreach($hospitals as $row)
                @php
                    $groupCnt = $data->where('org_code', $row->org_code)->count();
                    $noneData = ($groupCnt === 0);
                @endphp
                <li @class(['no-data' => $noneData])>
                    <div class="name">
                        <div class="checkbox-wrap text-center">
                            <x-input.checkbox id="application_org_code_{{ $row->sid }}" field="application_org_code" value="{{ $row->org_code }}" :text="$row->org_name" class="application-org-code"/>
                        </div>
                    </div>

                    <div class="result">
                        <strong>{{ number_format($groupCnt) }}</strong> 건
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="btn-wrap text-center mt-20">
            <button type="submit" class="btn btn-type1 color-type2">타 기관 데이터 신청</button>
        </div>
    </fieldset>
</form>

@push('application-script')
    <script>
        const applicationForm = '#application-frm';
    </script>
@endpush