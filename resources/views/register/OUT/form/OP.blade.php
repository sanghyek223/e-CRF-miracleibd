@php
    $opConfig = $registerConfig['OUT']['OP'];
    $op_list_max = $opConfig['op_list_max'];

    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Outcome | Surgery</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <tbody>
        <tr>
            <th scope="row">
                수술력
            </th>
            <td colspan="3" class="text-left ESS-CHK">
                <div class="radio-wrap">
                    @foreach($registerConfig['yn'] as $key => $val)
                        <x-input.radio field="out_OP" value="{{ $key }}" :text="$val" :data="$register->out_OP"/>
                    @endforeach
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

@include('register.include.status')

<div class="table-wrap op-list-wrap"  style="display: {{ $register->is_OP_y ? '' : 'none' }}">
    <table class="cst-table">
        <caption class="hide">Outcome | Surgery</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>

        <tbody>
        <tr>
            <th colspan="4" class="active has-btn nbdb">
                수술
                <a href="javascript:void(0);" class="btn btn-small color-type3 op-list-add" title="추가">수술 추가</a>
            </th>
        </tr>

        <tr>
            <td colspan="4" class="has-tbl nobd">
                <table class="inner-tbl">
                    <colgroup>
                        <col style="width: 10%;">
                        <col style="width: auto;">
                        <col style="width: 21%;">
                    </colgroup>

                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">수술명</th>
                        <th scope="col">수술일</th>
                    </tr>
                    </thead>

                    <tbody id="op-list-tbody">
                    @for($i = 1; $i <= $op_list_max; $i++)
                        @if($i !== 1 && $i > $register->out_OP_cnt) @continue @endif
                        @include('register.OUT.include.OP-list', [ 'eq' => $i, 'register' => $register ])
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
        const op_list_max = @json($op_list_max);

        $(function () {
            validateEssChk();
        });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);
            ajaxData.append('out_OP_cnt', $(form).find('.op-list-tr').length);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('change', `${form} input[name=out_OP]`, function () {
            const value = $(form).find('input[name=out_OP]:checked').val() || '';
            const target = $(form).find('.op-list-wrap');

            if (parseInt(value) === 1) {
                target.show();
            } else {
                target.hide();
                target.find('input[type=text]').val('');
            }

            validateEssChk();
        });

        $(document).on('click', `${form} .op-list-add`, function () {
            const length = $(form).find('.op-list-tr').length;

            if (op_list_max <= length) {
                alert(`최대 ${op_list_max}까지 추가 가능합니다.`);
                return false;
            }

            callbackAjax(dataUrl, {
                'case': 'op-list-add',
                'eq': (length + 1),
            }, function (data, error) {
                if (error) {
                    ajaxErrorData(error);
                    return false;
                }

                ajaxSuccessData(data);
                callTargetReplaceDatePicker();
                validateEssChk();
            });
        });

        $(document).on('click', `${form} .op-list-del`, function () {
            const _this = $(this);

            if (confirm('삭제 하시겠습니까?')) {
                _this.closest('tr').remove();

                $(form).find('.op-list-tr').each(function (index, item) {
                    const eq = (index + 1);

                    $(item).find('.op-list-eq').html(`${eq}차`)

                    const op_text = `out_OP${eq}`;
                    $(item).find('.op-list-text')
                        .attr('name', op_text)
                        .attr('id', op_text);

                    const op_y = `out_OP${eq}_d_y`;
                    $(item).find('.op-list-y')
                        .attr('name', op_y)
                        .attr('id', op_y);

                    const op_m = `out_OP${eq}_d_m`;
                    $(item).find('.op-list-m')
                        .attr('name', op_m)
                        .attr('id', op_m);

                    const op_d = `out_OP${eq}_d_d`;
                    $(item).find('.op-list-d')
                        .attr('name', op_d)
                        .attr('id', op_d);
                });

                validateEssChk();
            }
        });
    </script>
@endpush