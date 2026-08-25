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

        $backup1_field = $dataConfig['backup1_field'];
        $backup2_field = $dataConfig['backup2_field'];
        $Patient_field = (new \App\Models\Patient())->getExcelField();

        $Fu_count = $patients->sum('Fu_count');
        $excel_count = 1;
    @endphp

    <thead>
    <tr>
        <th rowspan="2">No</th>

        <th colspan="{{ count($Patient_field) + 2 }}" style="background-color: {{ $background_color1 }};">
            {{ $backup1_field['backup1_DEFAULT']['name'] }}
        </th>

        @if(!empty($request->backup2_FU_BX))
            @php
                $FuBX_field = (new \App\Models\FuBX())->getExcelField();
            @endphp

            <th colspan="{{ count($FuBX_field) }}" style="background-color: {{ $background_color2 }};">
                {{ $backup2_field['backup2_FU']['sub']['backup2_FU_BX'] }}
            </th>
        @endif

        @if(!empty($request->backup2_FU_LAB))
            @php
                $FuLAB_field = (new \App\Models\FuLAB())->getExcelField();
            @endphp

            <th colspan="{{ count($FuLAB_field) }}" style="background-color: {{ $background_color3 }};">
                {{ $backup2_field['backup2_FU']['sub']['backup2_FU_LAB'] }}
            </th>
        @endif

        @if(!empty($request->backup2_FU_ENDO))
            @php
                $FuENDO_field = (new \App\Models\FuENDO())->getExcelField();
            @endphp

            <th colspan="{{ count($FuENDO_field) }}" style="background-color: {{ $background_color4 }};">
                {{ $backup2_field['backup2_FU']['sub']['backup2_FU_ENDO'] }}
            </th>
        @endif

        @if(!empty($request->backup2_FU_IMG))
            @php
                $FuIMG_field = (new \App\Models\FuIMG())->getExcelField();
            @endphp

            <th colspan="{{ count($FuIMG_field) }}" style="background-color: {{ $background_color5 }};">
                {{ $backup2_field['backup2_FU']['sub']['backup2_FU_IMG'] }}
            </th>
        @endif
    </tr>

    <tr>
        @foreach($Patient_field ?? [] as $key => $val /* 기본 정보 */)
            <th style="background-color: {{ $background_color1 }};">{{ $val }}</th>
        @endforeach
        <th style="background-color: {{ $background_color1 }};">FU_visit_d</th>
        <th style="background-color: {{ $background_color1 }};">FU_ibd_type</th>

        @foreach($FuBX_field ?? [] as $key => $val /* 검체 정보 */)
            <th style="background-color: {{ $background_color2 }};">{{ $val }}</th>
        @endforeach

        @foreach($FuLAB_field ?? [] as $key => $val /* 검체 획득 시점 Lab */)
            <th style="background-color: {{ $background_color3 }};">{{ $val }}</th>
        @endforeach

        @foreach($FuENDO_field ?? [] as $key => $val /* 검체 획득 시점 검사 */)
            <th style="background-color: {{ $background_color4 }};">{{ $val }}</th>
        @endforeach

        @foreach($FuIMG_field ?? [] as $key => $val /* 검체 획득 시점 영상 */)
            <th style="background-color: {{ $background_color5 }};">{{ $val }}</th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach($patients as $patient)
        @php
            $FuLIST = $patient->FuLIST;
        @endphp

        @foreach($FuLIST as $Fu)
            <tr>
                <td>{{ $excel_count++ }}</td>

                @foreach($Patient_field ?? [] as $key => $val /* 기본 정보 */)
                    <td>{{ $patient?->{$val} }}</td>
                @endforeach
                <td>{{ $Fu->FU_visit_d ?? '' }}</td>
                <td>{{ $Fu->FU_ibd_type ?? '' }}</td>

                @foreach($FuBX_field ?? [] as $key => $val /* 검체 정보 */)
                    <td>{{ $Fu->FuBX?->{$val} }}</td>
                @endforeach

                @foreach($FuLAB_field ?? [] as $key => $val /* 검체 획득 시점 Lab */)
                    <td>{{ $Fu->FuLAB?->{$val} }}</td>
                @endforeach

                @foreach($FuENDO_field ?? [] as $key => $val /* 검체 획득 시점 검사 */)
                    <td>{{ $Fu->FuENDO?->{$val} }}</td>
                @endforeach

                @foreach($FuIMG_field ?? [] as $key => $val /* 검체 획득 시점 영상 */)
                    <td>{{ $Fu->FuIMG?->{$val} }}</td>
                @endforeach
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>

</body>
</html>