<?php

return [
    'status' => [ // 등록 상태
        'N' => [
            'class' => 'waiting',
            'name' => '입력전',
        ],

        'I' => [
            'class' => 'ing',
            'name' => '입력중',
        ],

        'C' => [
            'class' => 'complete',
            'name' => '입력완료',
        ],
    ],

    'type' => [ // 등록 타입
        'BASE' => [
            'name' => "Baseline",
            'thead' => "Baseline",
            'first_tab' => 'DX',
        ],

        'OUT' => [
            'name' => "Outcome",
            'thead' => "Outcome",
            'first_tab' => 'MED',
        ],

        'FU' => [
            'name' => "Follow-up",
            'thead' => "Follow-up",
            'first_tab' => 'LIST',
        ],

        'END' => [
            'name' => "End of Study (Last F/U)",
            'thead' => "End of Study<br>(Last F/U)",
            'first_tab' => 'ENDO',
        ],

        'FASTQ' => [
            'name' => "Microbiome Data Upload",
            'thead' => "Microbiome<br>Data Upload",
            'first_tab' => 'UPLOAD',
        ],
    ],

    'tab' => [ // 등록 상세
        'BASE' => [
            'DX' => '진단 시점 정보',
            'ENDO' => '진단 시점 검사',
            'IMG' => '진단 시점 영상',
            'LAB' => '진단 시점 Lab',
            'NTR' => '영양 진자 설문',
            'EVN' => '환경 인자 설문',
        ],

        'OUT' => [
            'MED' => 'Medication',
            'OP' => 'Surgery',
            'V' => 'ER/Admission',
        ],

        'FU' => [
            'LIST' => 'Follow-up',
            'BX' => '검체 정보',
            'LAB' => '검체 획득 시점 Lab',
            'ENDO' => '검체 획득 시점 검사',
            'IMG' => '검체 획득 시점 영상',
        ],

        'END' => [
            'ENDO' => '마지막 내시경',
            'MED' => '마지막 F/U 시점의 약제 사용',
        ],

        'FASTQ' => [
            'UPLOAD' => 'Data upload',
        ],
    ],

    'yn' => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'BASE' => [
        'DX' => [
            'ibd_type' => [ // IBD Type
                '1' => 'UC',
                '2' => 'CD',
            ],

            'uc_location' => [ // Location
                '1' => 'E1 (proctitis)',
                '2' => 'E2 (left-sided)',
                '3' => 'E3 (extensive)',
                '9' => 'Undeterminate',
            ],

            'uc_severity' => [ // Severity
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
                '9' => 'Undeterminate',
            ],

            'cd_location' => [ // Location
                '1' => 'L1 (ileal)',
                '2' => 'L2 (colonic)',
                '3' => 'L3 (ileocolonic)',
                '9' => 'Undeterminate',
            ],

            'cd_severity' => [ // Severity
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
                '9' => 'Undeterminate',
            ],

            'behavior' => [ // Behavior
                '1' => 'B1',
                '2' => 'B2 (stricturing)',
                '31' => 'B3 (penetrating)',
            ],

            'b_bio_max' => 4,
        ],

        'ENDO' => [
            'b_MES' => array_combine(range(0, 3), range(0, 3)), // UC MES

            'b_SES_CD' => array_combine(range(0, 12), range(0, 12)), // SES-CD

            'b_endo_sev' => [ // 내시경 Severity
                '0' => 'inactive (remission)',
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
            ],

            'b_entero_sev' => [ // 소장내시경 Severity
                '0' => 'inactive (remission)',
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
            ],
        ],
    ],
];