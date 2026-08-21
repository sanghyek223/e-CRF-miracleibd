@php
    $vConfig = $registerConfig['OUT']['V'];
    $v_list_max = $vConfig['v_list_max'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | ER/Admission</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <tbody>
        <tr>
            <th scope="row">
                ER/Admission 발생 유무
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_visit" value="{{ $key }}" :text="$val" :data="$register->out_visit"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@include('register.include.status')

<div class="table-wrap v-list-wrap"  style="display: {{ $register->is_visit_y ? '' : 'none' }}">
    <table class="cst-table">
        <caption class="hide">Outcome | ER/Admission</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th colspan="4" class="active has-btn nbdb">
                ER/Admission
                <a href="javascript:void(0);" class="btn btn-small color-type3 v-list-add" title="추가">행 추가</a>
            </th>
        </tr>

        <tr>
            <td colspan="4" class="has-tbl nobd">
                <table class="inner-tbl">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: auto;">
                        <col style="width: 21%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">구분</th>
                        <th scope="col">사유</th>
                        <th scope="col">방문/입원일</th>
                    </tr>
                    </thead>

                    <tbody id="v-list-tbody">
                    @for($i = 1; $i <= $v_list_max; $i++)
                        @if($i !== 1 && $i > $register->out_visit_cnt) @continue @endif
                        @include('register.OUT.include.V-list', [ 'eq' => $i, 'register' => $register ])
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
        const v_list_max = @json($v_list_max);

        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);
            ajaxData.append('out_visit_cnt', $(form).find('.v-list-tr').length);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('change', `${form} input[name=out_visit]`, function () {
            const value = $(form).find('input[name=out_visit]:checked').val() || '';
            const target = $(form).find('.v-list-wrap');

            if (parseInt(value) === 1) {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
                target.find('input[type=radio]').prop('checked', false);
            }

            validateEssChk();
        });

        $(document).on('click', `${form} .v-list-add`, function () {
            const length = $(form).find('.v-list-tr').length;

            if (v_list_max <= length) {
                alert(`최대 ${v_list_max}까지 추가 가능합니다.`);
                return false;
            }

            callbackAjax(dataUrl, {
                'case': 'v-list-add',
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

        $(document).on('click', `${form} .v-list-del`, function () {
            const _this = $(this);

            if (confirm('삭제 하시겠습니까?')) {
                _this.closest('tr').remove();

                $(form).find('.v-list-tr').each(function (index, item) {
                    const eq = (index + 1);

                    $(item).find('.v-list-eq').html(`${eq}차`)

                    const visit_radio = `out_visit${eq}_k`;
                    $(item).find('.v-list-radio1')
                        .attr('name', visit_radio)
                        .attr('id', `${visit_radio}1`);

                    $(item).find('.v-list-radio2')
                        .attr('name', visit_radio)
                        .attr('id', `${visit_radio}2`);

                    const visit_text = `out_visit${eq}_w`;
                    $(item).find('.v-list-text')
                        .attr('name', visit_text)
                        .attr('id', visit_text);

                    const visit_y = `out_visit${eq}_d_y`;
                    $(item).find('.v-list-y')
                        .attr('name', visit_y)
                        .attr('id', visit_y);

                    const visit_m = `out_visit${eq}_d_m`;
                    $(item).find('.v-list-m')
                        .attr('name', visit_m)
                        .attr('id', visit_m);

                    const visit_d = `out_visit${eq}_d_d`;
                    $(item).find('.v-list-d')
                        .attr('name', visit_d)
                        .attr('id', visit_d);
                });

                validateEssChk();
            }
        });
    </script>
@endpush