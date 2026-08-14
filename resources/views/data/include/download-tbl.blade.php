@php
    $rawData = $rawData ?? null;
    $disabled = $disabled ?? false;
    $FASTQ_LOOP = 1;
@endphp

<div class="table-wrap" id="download-FASTQ-tbl-wrap">
    <table class="cst-table {{ $addClass ?? '' }}" id="download-tbl">
        <caption class="hide">신청내역 다운로드 상세</caption>

        <colgroup>
            <col style="width:8%">
            <col style="width:13%">
            <col style="width:25%;">
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
                <td class="progress-state">
                    <a href="{{ route('data.download.FASTQ', ['download_type' => 'choice']) }}" class="btn btn-type1 btn-line color-type3 FASTQ-one-download"><span class="icon mr-10">
                        <img src="/assets/image/icon/ic_download.png" alt=""></span>다운로드
                    </a>
                </td>
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

<template id="progress-template">
    <div class="bg-box type-info progress-div-info">
        <div class="progress-wrap mb-0">
            <div class="download-progress-bar">
                <progress max="100" value="0" class="all"></progress>
                <div class="value-wrap">
                    <p data-value="0" class="value"></p>
                </div>
            </div>

            <div class="desc progress-desc"></div>
        </div>
    </div>
</template>