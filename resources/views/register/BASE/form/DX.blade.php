@php
    $dxConfig = $registerConfig['BASE']['DX'];
    $b_bio_max = $dxConfig['b_bio_max'];

    $register = $register->additionalData(); // 데이터 가공 & 추가

    $uc_display = $register->is_uc ? '' : 'none';
    $cd_display = $register->is_cd ? '' : 'none';
    $med_display = $register->is_med ? '' : 'none';
    $bio_display = $register->is_bio ? '' : 'none';
@endphp

@include('register.include.status')

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Baseline | 진단 시점 정보</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <thead>
        <tr>
            <th scope="col" colspan="4">진단 시점 정보</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <th scope="row">진단일</th>
            <td class="text-left ESS-CHK">
                <div class="form-group date">
                    <x-input.text field="IBD_d_y" :data="$register->IBD_d_y" class="form-item line small text-center dateY date-calc" maxlength="4" onlynumber/> /
                    <x-input.text field="IBD_d_m" :data="$register->IBD_d_m" class="form-item line small text-center dateM date-calc" maxlength="2" onlynumber/> /
                    <x-input.text field="IBD_d_d" :data="$register->IBD_d_d" class="form-item line small text-center dateD date-calc" maxlength="2" onlynumber/>
                    <img src="/assets/image/icon/ic_cal.png" alt="" class="target-replace-datepicker date-calc" data-target="IBD_d" data-maxdate="{{ now()->format('Y-m-d') }}">
                </div>
            </td>

            <th scope="row">진단 시 나이</th>
            <td class="text-left ESS-CHK">
                만 <x-input.text field="IBD_age" :data="$register->IBD_age" class="form-item small text-center" readonly/> 세
            </td>
        </tr>

        <tr>
            <th scope="row">IBD Type</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['IBD_type'] as $key => $val)
                        <x-input.radio field="IBD_type" value="{{ $key }}" :text="$val" :data="$register->IBD_type"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th scope="row">키</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_HT" :data="$register->b_HT" class="form-item small text-center" onlydecimal/> cm
            </td>

            <th scope="row">체중</th>
            <td class="text-left ESS-CHK">
                <x-input.text field="b_WT" :data="$register->b_WT" class="form-item small text-center" onlydecimal/> kg
            </td>
        </tr>

        <tr>
            <th scope="row">BMI</th>
            <td colspan="3" class="text-left ESS-CHK">
                <x-input.text field="b_BMI" :data="$register->b_BMI" class="form-item small text-center" readonly/> ㎏/㎡
            </td>
        </tr>

        <tr class="uc-tr" style="display: {{ $uc_display }}">
            <th colspan="4" class="active">UC</th>
        </tr>

        <tr class="uc-tr" style="display: {{ $uc_display }}">
            <th scope="row">Location</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['uc_location'] as $key => $val)
                        <x-input.radio field="b_UC_l" value="{{ $key }}" :text="$val" :data="$register->b_UC_l"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">Severity</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['uc_severity'] as $key => $val)
                        <x-input.radio field="b_UC_sens" value="{{ $key }}" :text="$val" :data="$register->b_UC_sens"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="cd-tr" style="display: {{ $cd_display }}">
            <th colspan="4" class="active">CD</th>
        </tr>

        <tr class="cd-tr" style="display: {{ $cd_display }}">
            <th scope="row">Location</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['cd_location'] as $key => $val)
                        <x-input.radio field="b_CD_l" value="{{ $key }}" :text="$val" :data="$register->b_CD_l"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">L4 (Upper GI)</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_CD_L4" value="{{ $key }}" :text="$val" :data="$register->b_CD_L4"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="cd-tr" style="display: {{ $cd_display }}">
            <th scope="row">Severity</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['cd_severity'] as $key => $val)
                        <x-input.radio field="b_CD_sens" value="{{ $key }}" :text="$val" :data="$register->b_CD_sens"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">Behavior</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($dxConfig['behavior'] as $key => $val)
                        <x-input.radio field="b_CD_behav" value="{{ $key }}" :text="$val" :data="$register->b_CD_behav"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="cd-tr" style="display: {{ $cd_display }}">
            <th scope="row">Perianal Modifier</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_CD_PA_modi" value="{{ $key }}" :text="$val" :data="$register->b_CD_PA_modi"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr>
            <th colspan="4" class="active">약물</th>
        </tr>

        <tr>
            <th scope="row">약물 투약 여부</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_med" value="{{ $key }}" :text="$val" :data="$register->b_med"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $med_display }}">
            <th scope="row">5-ASA</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_5ASA" value="{{ $key }}" :text="$val" :data="$register->b_5ASA"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">Azathioprine</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_aza" value="{{ $key }}" :text="$val" :data="$register->b_aza"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $med_display }}">
            <th scope="row">Methotrexate</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_MTX" value="{{ $key }}" :text="$val" :data="$register->b_MTX"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">Tofactinibs</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_tofa" value="{{ $key }}" :text="$val" :data="$register->b_tofa"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $med_display }}">
            <th scope="row">Ozanimod</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_oza" value="{{ $key }}" :text="$val" :data="$register->b_oza"/>
                    @endforeach
                </div>
            </td>

            <th scope="row">Steriod</th>
            <td class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_st" value="{{ $key }}" :text="$val" :data="$register->b_st"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="med-tr" style="display: {{ $med_display }}">
            <th scope="row">생물학적제제 투약 여부</th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="b_bio" value="{{ $key }}" :text="$val" :data="$register->b_bio"/>
                    @endforeach
                </div>
            </td>
        </tr>

        <tr class="bio-tr" style="display: {{ $bio_display }}">
            <th colspan="4" class="active has-btn nbdb">
                생물학적제제 상세 현황
                <a href="javascript:void(0);"  class="btn btn-small color-type3 bio-detail-add" title="추가">Biologics 추가</a>
            </th>
        </tr>

        <tr class="bio-tr" style="display: {{ $bio_display }}">
            <td colspan="4" class="has-tbl nobd">
                <table class="inner-tbl">
                    <colgroup>
                        <col style="width: 12%;">
                        <col style="width: auto;">
                        <col style="width: 21%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">차수</th>
                        <th scope="col">Name</th>
                        <th scope="col">투약 시작일</th>
                    </tr>
                    </thead>

                    <tbody id="bio-detail-tbody">
                    @for($i = 1; $i <= $b_bio_max; $i++)
                        @if($i !== 1 && $i > $register->b_bio_cnt) @continue @endif
                        @include('register.BASE.include.DX-bio-detail', [ 'eq' => $i, 'register' => $register ])
                    @endfor
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        const birth = '{{ $patient->birth_d }}';
        const b_bio_max = @json($b_bio_max);

        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);
            ajaxData.append('b_bio_cnt', $(form).find('.bio-detail-tr').length);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        function dateCalc() {
            let calc = true;
            let age = '';

            $('input[type=text].date-calc').each(function (index, item) {
                if (isEmpty($(item).val())) {
                    calc = false;
                    return false;
                }
            });

            if (calc) {
                const IBD_STR   = $('#IBD_d_y').val() + "-" + $('#IBD_d_m').val() + '-' + $('#IBD_d_d').val();

                // 엄격 모드 + 포맷 지정
                const BIRTH_FORMAT = moment(birth, 'YYYY-MM-DD', true);
                const IBD_FORMAT   = moment(IBD_STR, 'YYYY-MM-DD', true);

                // 유효성 체크
                if (!BIRTH_FORMAT.isValid() || !IBD_FORMAT.isValid()) {
                    console.warn('날짜 형식 불일치');
                    return;
                }

                // 미래 날짜 방지 (옵션)
                if (IBD_FORMAT.isBefore(BIRTH_FORMAT)) {
                    console.warn('진단일이 생년월일보다 빠름');
                    alert("진단일이 생년월일보다 이전 날짜로 입력되었습니다.\n생년월일과 진단일을 다시 확인해 주십시오.");

                    $(`#IBD_d_y`).val('');
                    $(`#IBD_d_m`).val('');
                    $(`#IBD_d_d`).val('');
                    return;
                }

                age = IBD_FORMAT.diff(BIRTH_FORMAT, 'years');
            }

            $(form).find('#IBD_age').val(age);
            validateEssChk();
        }

        $(document).on('change', `${form} input[name=IBD_type]`, function () {
            const type = $(form).find('input[name=IBD_type]:checked').val() || '';
            const type1_target = $(form).find('.uc-tr');
            const type2_target = $(form).find('.cd-tr');

            switch (type) {
                case '1':
                    type1_target.show();

                    type2_target.hide();
                    type2_target.find('input[type=radio]').prop('checked', false);
                    break;

                case '2':
                    type2_target.show();

                    type1_target.hide();
                    type1_target.find('input[type=radio]').prop('checked', false);
                    break;

                default:
                    type1_target.hide();
                    type1_target.find('input[type=radio]').prop('checked', false);

                    type2_target.hide();
                    type2_target.find('input[type=radio]').prop('checked', false);
                    break;
            }

            validateEssChk();
        });

        $(document).on('keyup', `${form} input[name=b_HT], ${form} input[name=b_WT]`, function () {
            const b_HT = $(form).find('input[name=b_HT]').val() || '';
            const b_WT = $(form).find('input[name=b_WT]').val() || '';
            let bmi = '';

            if (!isEmpty(b_HT) && !isEmpty(b_WT)) {
                const height_m = parseFloat(b_HT) / 100; // cm -> m
                const weight_kg = parseFloat(b_WT);

                if (height_m > 0 && !isNaN(weight_kg)) {
                    bmi = (weight_kg / (height_m * height_m)).toFixed(2); // 소수점 2자리
                }
            }

            $(form).find('#b_BMI').val(bmi);
        });

        $(document).on('change', `${form} input[name=b_med]`, function () {
            const value = $(form).find('input[name=b_med]:checked').val() || '';
            const target = $(form).find('.med-tr');

            if (parseInt(value) === 1) {
                target.show();
            } else {
                target.hide();
                target.find('input[type=radio]').prop('checked', false);
            }

            validateEssChk();
        });

        $(document).on('change', `${form} input[name=b_bio]`, function () {
            const value = $(form).find('input[name=b_bio]:checked').val() || '';
            const target = $(form).find('.bio-tr');

            if (parseInt(value) === 1) {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
            }

            validateEssChk();
        });

        $(document).on('click', `${form} .bio-detail-add`, function () {
            const length = $(form).find('.bio-detail-tr').length;

            if (b_bio_max <= length) {
                alert(`최대 ${b_bio_max}까지 추가 가능합니다.`);
                return false;
            }

            callbackAjax(dataUrl, {
                'case': 'DX-bio-detail-add',
                'eq': (length + 1),
            }, function (data, error) {
                if (error) {
                    ajaxErrorData(error);
                    return false;
                }

                ajaxSuccessData(data);
                validateEssChk();
            });
        });

        $(document).on('click', `${form} .bio-detail-del`, function () {
            const _this = $(this);

            if (confirm('삭제 하시겠습니까?')) {
                _this.closest('tr').remove();

                $(form).find('.bio-detail-tr').each(function (index, item) {
                    const eq = (index + 1);

                    $(item).find('.bio-detail-eq').html(`${eq}차`)

                    const bio_n = `b_bio${eq}_n`;
                    $(item).find('.bio-detail-text')
                        .attr('name', bio_n)
                        .attr('id', bio_n);

                    const bio_y = `b_bio${eq}_d_y`;
                    $(item).find('.bio-detail-y')
                        .attr('name', bio_y)
                        .attr('id', bio_y);

                    const bio_m = `b_bio${eq}_d_m`;
                    $(item).find('.bio-detail-m')
                        .attr('name', bio_m)
                        .attr('id', bio_m);

                    const bio_d = `b_bio${eq}_d_d`;
                    $(item).find('.bio-detail-d')
                        .attr('name', bio_d)
                        .attr('id', bio_d);
                });

                validateEssChk();
            }
        });
    </script>
@endpush