@php
    $uploadConfig = $registerConfig['FASTQ']['UPLOAD'];
    $register = $register->additionalData(); // 데이터 가공 & 추가
@endphp

<div class="table-wrap">
    <table class="cst-table">
        <caption class="hide">Microbiome Data Upload</caption>
        <colgroup>
            <col style="width: 20%;">
            <col>
            <col style="width: 20%;">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th scope="col" colspan="4">FASTQ 파일 업로드</th>
        </tr>
        </thead>
        <tbody>
        @foreach($uploadConfig['file'] as $key => $val)
            <tr>
                <th scope="row">{{ $val }}</th>
                <td colspan="3" class="text-left">
                    <div class="filebox">
                        <x-input.text field="{{ $key }}_name" class="upload-name form-item" placeholder="선택된 파일 없음" readonly/>
                        <label for="{{ $key }}" class="">파일 선택</label>
                        <x-input.file field="{{ $key }}" class="file-upload" accept=".jpg, .jpeg, .png, .gif"/>

                        @if (!empty($register->{$key . "_name"}))
                            <div class="attach-file">
                                <a href="{{ $register->downloadUrl($key) }}" class="link">
                                    {{ $register->{$key . "_name_real"} }}
                                </a>

                                <a href="javascript:void(0);" class="btn-file-delete text-red">X</a>
                            </div>
                            <input type="hidden" name="{{ $key }}_del" id="{{ $key }}_del" value="N" readonly>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('register-script')
    <script>
        // $(function () {
        //     validateEssChk();
        // });

        function submitAction(next = false) {
            let ajaxData = newFormData(form);

            if (next) {
                ajaxData.append('next', true);
            }

            callMultiAjax(dataUrl, ajaxData);
        }

        $(document).on('click', 'input[type=file]', function (e) {
            const target = $(this).closest('.filebox').find('.attach-file');

            if (!fileDelCheck(target)) {
                e.preventDefault();
            }
        });

        $(document).on('change', 'input[type=file]', function () {
            const name = $(this).attr('name');
            fileCheck(this, `#${name}_name`);
        });

        $(document).on('click', '.btn-file-delete', function () {
            const name = $(this).closest('.filebox').find('input[type=file]').attr('name');
            const target = $(this).closest('.filebox').find('.attach-file');

            target.remove();
            $(`#${name}_del`).val('Y');
        });
    </script>
@endpush