<form id="sch-frm">
    <fieldset>
        <legend class="hide">데이터 열람 / 신청</legend>

        <div class="table-wrap">
            <table class="cst-table">
                <caption class="hide">데이터 열람 / 신청</caption>
                <colgroup>
                    <col style="width: 20%;">
                    <col>
                    <col style="width: 20%;">
                    <col>
                </colgroup>

                <tbody>
                <tr>
                    <th scope="row">
                        기관
                    </th>
                    <td colspan="3" class="text-left">
                        <div class="checkbox-wrap">
                            @foreach($hospitals as $row)
                                <x-input.checkbox id="org_code_{{ $row->sid }}" field="org_code" value="{{ $row->org_code }}" :text="$row->org_name" :checked="in_array($row->org_code, request()->input('org_code', []))"/>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        등록 날짜
                    </th>
                    <td colspan="3" class="text-left">
                        <div class="form-group date">
                            <x-input.text field="created_at_s" :data="request()->input('created_at_s', '')" class="form-item line short text-center"/>
                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_s">

                            <span>~</span>

                            <x-input.text field="created_at_e" :data="request()->input('created_at_e', '')" class="form-item line short text-center"/>
                            <img src="/assets/image/icon/ic_cal.png" alt="" class="target-datepicker" data-target="created_at_e">
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        성별
                    </th>
                    <td colspan="3" class="text-left">
                        <div class="checkbox-wrap">
                            @foreach($patientConfig['sex'] as $key => $val)
                                <x-input.checkbox id="sex_{{ $key }}" field="sex" value="{{ $key }}" :text="$val" :checked="in_array($key, request()->input('sex', []))"/>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        진단시 나이
                    </th>
                    <td colspan="3" class="text-left">
                        <div class="form-group date">
                            만 <x-input.text field="IBD_age_s" :data="request()->input('IBD_age_s', '')" class="form-item line small text-center"/> 세
                            <span class="text"> ~ </span>
                            만 <x-input.text field="IBD_age_e" :data="request()->input('IBD_age_e', '')" class="form-item line small text-center"/> 세
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        IBD Type
                    </th>
                    <td colspan="3" class="text-left">
                        <div class="checkbox-wrap">
                            @foreach($registerConfig['BASE']['DX']['IBD_type'] as $key => $val)
                                <x-input.checkbox id="IBD_type_{{ $key }}" field="IBD_type" value="{{ $key }}" :text="$val" :checked="in_array($key, request()->input('IBD_type', []))"/>
                            @endforeach
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="btn-wrap text-center mt-20">
            <button type="submit" class="btn btn-type1 color-type3">검색</button>
            <a href="{{ route('data') }}" class="btn btn-type1 btn-line color-type3">검색 초기화</a>
        </div>
    </fieldset>
</form>

@push('sch-script')
    <script>
        const schForm = '#sch-frm';
    </script>
@endpush