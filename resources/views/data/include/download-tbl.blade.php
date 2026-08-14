@php
    $rawData = $rawData ?? null;
    $disabled = $disabled ?? false;
    $FASTQ_LOOP = 1;
@endphp

<div class="table-wrap download-FASTQ-tbl-wrap">
    <table class="cst-table {{ $addClass ?? '' }}" id="download-tbl">
        <caption class="hide">신청내역 다운로드 상세</caption>

        <colgroup>
            <col style="width:12%">
            <col style="width:14%">
            <col style="width:24%;">
            <col style="width:12%;">
            <col style="width:auto;">
        </colgroup>

        <thead>
        <tr>
            <th scope="col">
                <div class="checkbox-wrap text-center">
                    <x-input.checkbox id="FASTQ_all" field="FASTQ_all" value="Y" text="ALL DATA" :disabled="$disabled"/>
                </div>
            </th>
            <th scope="col">대상자 ID</th>
            <th scope="col">파일명</th>
            <th scope="col">용량</th>
            <th scope="col">상태/관리</th>
        </tr>
        </thead>

        <tbody>
        @forelse($patientsFASTQ as $row)
            <tr>
                <td>
                    <div class="checkbox-wrap text-center">
                        <x-input.checkbox3 id="FILE_KEY{{ $FASTQ_LOOP++ }}" field="FILE_KEY" value="{{ enCryptString($row->sid) }}" :disabled="$disabled" class="FASTQ-chk"/>
                    </div>
                </td>
                <td>{{ $row->regist_num }}</td>
                <td>{!! implode('<br>', $row->FASTQ->getFileNameAll()) !!}</td>
                <td>{{ formatBytes(array_sum($row->FASTQ->getFileSizeAll())) }}</td>
                <td class="progress-state"></td>
            </tr>
        @empty
            <tr>
                <td colspan="5">파일이 없습니다.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <p class="mt-5 text-right text-">
        *압축 파일(.zip) 형태로 제공됩니다.
    </p>
</div>