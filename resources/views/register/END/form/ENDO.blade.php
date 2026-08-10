@php
    $endoConfig = $registerConfig['END']['ENDO'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">End of Study (Last F/U) | 마지막 내시경</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">마지막 내시경</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">
                내시경 시행일
            </th>
            <td class="text-left ESS-CHK">
                <div class="form-group date">
                    <select name="end_endo_year" id="end_endo_year" class="form-item w-20p">
                        <option value="">년</option>
                        @for ($i = $registerConfig['year_end']; $i >= $registerConfig['year_start']; $i--)
                            <option value="{{ $i }}" {{ ($register->end_endo_year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>

                    <select name="end_endo_month" id="end_endo_month" class="form-item w-20p">
                        <option value="">월</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($register->end_endo_month ?? '') == $i ? 'selected' : '' }}>{{ $i }}월</option>
                        @endfor
                    </select>
                </div>
            </td>

            <th scope="row">
                평가일
            </th>
            <td class="text-left ESS-CHK">
                <div class="form-group date">
                    <select name="end_asst_year" id="end_asst_year" class="form-item w-20p">
                        <option value="">년</option>
                        @for ($i = $registerConfig['year_end']; $i >= $registerConfig['year_start']; $i--)
                            <option value="{{ $i }}" {{ ($register->end_asst_year ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>

                    <select name="end_asst_month" id="end_asst_month" class="form-item w-20p">
                        <option value="">월</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ ($register->end_asst_month ?? '') == $i ? 'selected' : '' }}>{{ $i }}월</option>
                        @endfor
                    </select>
                </div>
            </td>
        </tr>

        @if(!$register->is_uc && !$register->is_cd)
            @include('register.include.none-ibd')
        @else
            @if($register->is_uc)
                <tr>
                    <th colspan="4" class="active">
                        UC
                    </th>
                </tr>

                <tr>
                    <th scope="row">
                        Location
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($endoConfig['end_UC_l'] as $key => $val)
                                <x-input.radio field="end_UC_l" value="{{ $key }}" :text="$val" :data="$register->end_UC_l"/>
                            @endforeach
                        </div>
                    </td>

                    <th scope="row">
                        Severity
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($endoConfig['end_UC_sens'] as $key => $val)
                                <x-input.radio field="end_UC_sens" value="{{ $key }}" :text="$val" :data="$register->end_UC_sens"/>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif

            @if($register->is_cd)
                <tr>
                    <th colspan="4" class="active">
                        CD
                    </th>
                </tr>

                <tr>
                    <th scope="row">
                        Location
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($endoConfig['end_CD_l'] as $key => $val)
                                <x-input.radio field="end_CD_l" value="{{ $key }}" :text="$val" :data="$register->end_CD_l"/>
                            @endforeach
                        </div>
                    </td>

                    <th scope="row">
                        L4 (Upper GI)
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($registerConfig['yn'] as $key => $val)
                                <x-input.radio field="end_CD_L4" value="{{ $key }}" :text="$val" :data="$register->end_CD_L4"/>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Severity
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($endoConfig['end_CD_sens'] as $key => $val)
                                <x-input.radio field="end_CD_sens" value="{{ $key }}" :text="$val" :data="$register->end_CD_sens"/>
                            @endforeach
                        </div>
                    </td>

                    <th scope="row">
                        Behavior
                    </th>
                    <td class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($endoConfig['end_CD_behav'] as $key => $val)
                                <x-input.radio field="end_CD_behav" value="{{ $key }}" :text="$val" :data="$register->end_CD_behav"/>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Perianal Modifier
                    </th>
                    <td colspan="3" class="text-left ESS-CHK">
                        <div class="radio-wrap">
                            @foreach($registerConfig['yn'] as $key => $val)
                                <x-input.radio field="end_CD_PA_modi" value="{{ $key }}" :text="$val" :data="$register->end_CD_PA_modi"/>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
        @endif
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endpush