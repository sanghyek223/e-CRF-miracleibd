<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @if(isset($preview))
        <style>
            body.preview {
                margin: 0;
                padding: 20px;
                height: 100vh;
                overflow: auto;
                background: #f5f5f5;
                font-family: "Malgun Gothic", sans-serif;
                font-size: 13px;
            }

            body.preview table {
                border-collapse: collapse;
                width: max-content;
                min-width: 100%;
                background: #fff;
                border: 2px solid #666;
            }

            /* 공통 */
            body.preview th,
            body.preview td {
                border: 1px solid #999;
                padding: 6px 8px;
                white-space: nowrap;
                text-align: center;
                vertical-align: middle;
            }

            /* 헤더 */
            body.preview thead th {
                background: #d9eaf7;
                font-weight: bold;
            }
        </style>
    @endif
</head>
<body @class(['preview' => isset($preview)])>

<table border="1">
    @php
        $background_color1 = '#e1e8ce';
        $background_color2 = '#c8d5d6';
        $background_color3 = '#ccceea';
        $background_color4 = '#eed2d7';
        $background_color5 = '#f2eadd';
        $background_color6 = '#d9e4dc';
        $background_color7 = '#e5d8e8';
        $background_color8 = '#d6e0ea';
        $background_color9 = '#ecdccb';
        $background_color10 = '#d8e2c8';
        $background_color11 = '#e8dcd0';
        $background_color12 = '#dbd8e6';

        $backup1_field = $dataConfig['backup1_field'];
        $excel_count = 1;
    @endphp
    <thead>
    <tr>
        <th rowspan="2">No</th>

        @if(!empty($request->backup1_DEFAULT))
            @php
                $Patient_field = (new \App\Models\Patient())->getExcelField();
            @endphp

            <th colspan="{{ count($Patient_field) }}" style="background-color: {{ $background_color1 }};">
                {{ $backup1_field['backup1_DEFAULT']['name'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_DX))
            @php
                $BaseDX_field = (new \App\Models\BaseDX())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseDX_field) }}" style="background-color: {{ $background_color2 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_DX'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_ENDO))
            @php
                $BaseENDO_field = (new \App\Models\BaseENDO())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseENDO_field) }}" style="background-color: {{ $background_color3 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_ENDO'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_IMG))
            @php
                $BaseIMG_field = (new \App\Models\BaseIMG())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseIMG_field) }}" style="background-color: {{ $background_color4 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_IMG'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_LAB))
            @php
                $BaseLAB_field = (new \App\Models\BaseLAB())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseLAB_field) }}" style="background-color: {{ $background_color5 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_LAB'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_NTR))
            @php
                $BaseNTR_field = (new \App\Models\BaseNTR())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseNTR_field) }}" style="background-color: {{ $background_color6 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_NTR'] }}
            </th>
        @endif

        @if(!empty($request->backup1_BASE_EVN))
            @php
                $BaseEVN_field = (new \App\Models\BaseEVN())->getExcelField();
            @endphp

            <th colspan="{{ count($BaseEVN_field) }}" style="background-color: {{ $background_color7 }};">
                {{ $backup1_field['backup1_BASE']['sub']['backup1_BASE_EVN'] }}
            </th>
        @endif

        @if(!empty($request->backup1_OUT_MED))
            @php
                $OutMED_field = (new \App\Models\OutMED())->getExcelField();
            @endphp

            <th colspan="{{ count($OutMED_field) }}" style="background-color: {{ $background_color8 }};">
                {{ $backup1_field['backup1_OUT_MED']['name'] }}
            </th>
        @endif

        @if(!empty($request->backup1_OUT_OP))
            @php
                $OutOP_field = (new \App\Models\OutOP())->getExcelField();
            @endphp

            <th colspan="{{ count($OutOP_field) }}" style="background-color: {{ $background_color9 }};">
                {{ $backup1_field['backup1_OUT_OP']['name'] }}
            </th>
        @endif

        @if(!empty($request->backup1_OUT_V))
            @php
                $OutV_field = (new \App\Models\OutV())->getExcelField();
            @endphp

            <th colspan="{{ count($OutV_field) }}" style="background-color: {{ $background_color10 }};">
                {{ $backup1_field['backup1_OUT_V']['name'] }}
            </th>
        @endif

        @if(!empty($request->backup1_END_ENDO))
            @php
                $EndENDO_field = (new \App\Models\EndENDO())->getExcelField();
            @endphp

            <th colspan="{{ count($EndENDO_field) }}" style="background-color: {{ $background_color11 }};">
                {{ $backup1_field['backup1_END']['sub']['backup1_END_ENDO'] }}
            </th>
        @endif

        @if(!empty($request->backup1_END_MED))
            @php
                $EndMED_field = (new \App\Models\EndMED())->getExcelField();
            @endphp

            <th colspan="{{ count($EndMED_field) }}" style="background-color: {{ $background_color12 }};">
                {{ $backup1_field['backup1_END']['sub']['backup1_END_MED'] }}
            </th>
        @endif
    </tr>

    <tr>
        @foreach($Patient_field ?? [] as $key => $val /* 기본 정보 */)
            <th style="background-color: {{ $background_color1 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseDX_field ?? [] as $key => $val /* 진단시점 정보 */)
            <th style="background-color: {{ $background_color2 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseENDO_field ?? [] as $key => $val /* 진단시점 검사 */)
            <th style="background-color: {{ $background_color3 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseIMG_field ?? [] as $key => $val /* 진단시점 영상 */)
            <th style="background-color: {{ $background_color4 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseLAB_field ?? [] as $key => $val /* 진단시점 Lab */)
            <th style="background-color: {{ $background_color5 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseNTR_field ?? [] as $key => $val /* 영양 인자 설문 */)
            <th style="background-color: {{ $background_color6 }};">{{ $val }}</th>
        @endforeach

        @foreach($BaseEVN_field ?? [] as $key => $val /* 환경 인자 설문 */)
            <th style="background-color: {{ $background_color7 }};">{{ $val }}</th>
        @endforeach

        @foreach($OutMED_field ?? [] as $key => $val /* Medication */)
            <th style="background-color: {{ $background_color8 }};">{{ $val }}</th>
        @endforeach

        @foreach($OutOP_field ?? [] as $key => $val /* Surgery */)
            <th style="background-color: {{ $background_color9 }};">{{ $val }}</th>
        @endforeach

        @foreach($OutV_field ?? [] as $key => $val /* ER/Admission */)
            <th style="background-color: {{ $background_color10 }};">{{ $val }}</th>
        @endforeach

        @foreach($EndENDO_field ?? [] as $key => $val /* 마지막 내시경 */)
            <th style="background-color: {{ $background_color11 }};">{{ $val }}</th>
        @endforeach

        @foreach($EndMED_field ?? [] as $key => $val /* 마지막 F/U 시점의 약제 사용 */)
            <th style="background-color: {{ $background_color12 }};">{{ $val }}</th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{{ $excel_count++ }}</td>

            @foreach($Patient_field ?? [] as $key => $val /* 기본 정보 */)
                <td>{{ $patient?->{$val} }}</td>
            @endforeach

            @foreach($BaseDX_field ?? [] as $key => $val /* 진단시점 정보 */)
                <td>{{ $patient->BaseDX?->{$val} }}</td>
            @endforeach

            @foreach($BaseENDO_field ?? [] as $key => $val /* 진단시점 검사 */)
                <td>{{ $patient->BaseENDO?->{$val} }}</td>
            @endforeach

            @foreach($BaseIMG_field ?? [] as $key => $val /* 진단시점 영상 */)
                <td>{{ $patient->BaseIMG?->{$val} }}</td>
            @endforeach

            @foreach($BaseLAB_field ?? [] as $key => $val /* 진단시점 Lab */)
                <td>{{ $patient->BaseLAB?->{$val} }}</td>
            @endforeach

            @foreach($BaseNTR_field ?? [] as $key => $val /* 영양 인자 설문 */)
                <td>{{ $patient->BaseNTR?->{$val} }}</td>
            @endforeach

            @foreach($BaseEVN_field ?? [] as $key => $val /* 환경 인자 설문 */)
                <td>{{ $patient->BaseEVN?->{$val} }}</td>
            @endforeach

            @foreach($OutMED_field ?? [] as $key => $val /* Medication */)
                <td>{{ $patient->OutMED?->{$val} }}</td>
            @endforeach

            @foreach($OutOP_field ?? [] as $key => $val /* Surgery */)
                <td>{{ $patient->OutOP?->{$val} }}</td>
            @endforeach

            @foreach($OutV_field ?? [] as $key => $val /* ER/Admission */)
                <td>{{ $patient->OutV?->{$val} }}</td>
            @endforeach

            @foreach($EndENDO_field ?? [] as $key => $val /* 마지막 내시경 */)
                <td>{{ $patient->EndENDO?->{$val} }}</td>
            @endforeach

            @foreach($EndMED_field ?? [] as $key => $val /* 마지막 F/U 시점의 약제 사용 */)
                <td>{{ $patient->EndMED?->{$val} }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>