@php
    $rawData = $rawData ?? null;
    $click = $click ?? true;
@endphp

<table class="cst-table {{ $addClass ?? '' }}" id="backup1-tbl">
    <caption class="hide">백업</caption>
    <colgroup>
        <col style="width: 15%;">
        <col style="width: 20%;">
        <col>
        <col style="width: 20%;">
    </colgroup>

    <thead>
    <tr>
        <th scope="col">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_all" field="backup1_all" value="Y" text="ALL DATA" :click="$click"/>
            </div>
        </th>
        <th scope="col" colspan="2">입력폼</th>
        <th scope="col">건수</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <th scope="row" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_DEFAULT" field="backup1_DEFAULT" value="Y" :data="$rawData?->backup1_DEFAULT" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th colspan="2" class="text-left">기본 정보</th>
        <td rowspan="12">{{ number_format($backup1_count) }} 건</td>
    </tr>

    <tr>
        <th scope="row" rowspan="6" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_BASE" field="backup1_BASE" value="Y" :data="$rawData?->backup1_BASE" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th scope="row" rowspan="6" class="text-left">{{ $registerConfig['type']['BASE']['name'] }}</th>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_DX" field="backup1_BASE_DX" value="Y" :data="$rawData?->backup1_BASE_DX" :text="$registerConfig['tab']['BASE']['DX']" :click="$click" class="backup-chk backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_ENDO" field="backup1_BASE_ENDO" value="Y" :data="$rawData?->backup1_BASE_ENDO" :text="$registerConfig['tab']['BASE']['ENDO']" :click="$click" class="backup-chk backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_IMG" field="backup1_BASE_IMG" value="Y" :data="$rawData?->backup1_BASE_IMG" :text="$registerConfig['tab']['BASE']['IMG']" :click="$click" class="backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>
    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_LAB" field="backup1_BASE_LAB" value="Y" :data="$rawData?->backup1_BASE_LAB" :text="$registerConfig['tab']['BASE']['LAB']" :click="$click" class="backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_NTR" field="backup1_BASE_NTR" value="Y" :data="$rawData?->backup1_BASE_NTR" :text="$registerConfig['tab']['BASE']['NTR']" :click="$click" class="backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_BASE_EVN" field="backup1_BASE_EVN" value="Y" :data="$rawData?->backup1_BASE_EVN" :text="$registerConfig['tab']['BASE']['EVN']" :click="$click" class="backup-chk backup1-BASE"/>
            </div>
        </td>
    </tr>

    <tr>
        <th scope="row" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_OUT_MED" field="backup1_OUT_MED" value="Y" :data="$rawData?->backup1_OUT_MED" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['MED'] }}</th>
    </tr>

    <tr>
        <th scope="row" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_OUT_OP" field="backup1_OUT_OP" value="Y" :data="$rawData?->backup1_OUT_OP" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['OP'] }}</th>
    </tr>

    <tr>
        <th scope="row" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_OUT_V" field="backup1_OUT_V" value="Y" :data="$rawData?->backup1_OUT_V" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th colspan="2" class="text-left">{{ $registerConfig['tab']['OUT']['V'] }}</th>
    </tr>

    <tr>
        <th scope="row" rowspan="2" class="bg-gray">
            <div class="checkbox-wrap text-center">
                <x-input.checkbox id="backup1_END" field="backup1_END" value="Y" :data="$rawData?->backup1_END" :click="$click" class="backup-chk"/>
            </div>
        </th>
        <th rowspan="2" class="text-left">{{ $registerConfig['type']['END']['name'] }}</th>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_END_ENDO" field="backup1_END_ENDO" value="Y" :data="$rawData?->backup1_END_ENDO" :text="$registerConfig['tab']['END']['ENDO']" :click="$click" class="backup-chk backup1-END"/>
            </div>
        </td>
    </tr>

    <tr>
        <td class="text-left">
            <div class="checkbox-wrap">
                <x-input.checkbox id="backup1_END_MED" field="backup1_END_MED" value="Y" :data="$rawData?->backup1_END_MED" :text="$registerConfig['tab']['END']['MED']" :click="$click" class="backup-chk backup1-END"/>
            </div>
        </td>
    </tr>
    </tbody>
</table>