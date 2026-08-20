<?php

return [
    'search_params' => [ // 데이터 열람 / 신청시 검색 조건
        'created_at' => '등록 날짜',
        'sex' => '성별',
        'IBD_age' => '진단시 나이',
        'IBD_type' => 'IBD Type',
    ],

    'confirm' => [
        'N' => '승인 대기',
        'Y' => '승인 완료',
        'R' => '반려',
    ],

    'confirm_select' => [
        'Y' => '승인',
        'R' => '반려',
    ],

    'data_scope' => [
        'A' => 'FASTQ 파일',
        'B' => 'raw data',
        'Z' => 'FASTQ 파일 + raw data',
    ],

    'data_scope_file' => ['A', 'Z'], // FASTQ 파일 선택
    'data_scope_raw' => ['B', 'Z'], // Raw data 선택

    'download_edate_plus' => 7, // 다운로드 종료일 시작 일로 부터 + 게산용

    'backup1_field' => [
        'backup1_DEFAULT' => [
            'name' => '기본정보',
        ],

        'backup1_BASE' => [
            'name' => 'Baseline',
            'sub' => [
                'backup1_BASE_DX' => '진단 시점 정보',
                'backup1_BASE_ENDO' => '진단 시점 검사',
                'backup1_BASE_IMG' => '진단 시점 영상',
                'backup1_BASE_LAB' => '진단 시점 Lab',
                'backup1_BASE_NTR' => '영양 인자 설문',
                'backup1_BASE_EVN' => '환경 인자 설문',
            ],
        ],

        'backup1_OUT_MED' => [
            'name' => 'Medication',
        ],

        'backup1_OUT_OP' => [
            'name' => 'Surgery',
        ],

        'backup1_OUT_V' => [
            'name' => 'ER/Admission',
        ],

        'backup1_END' => [
            'name' => 'End of Study (Last F/U)',
            'sub' => [
                'backup1_END_ENDO' => '마지막 내시경',
                'backup1_END_MED' => '마지막 F/U 시점의 약제 사용',
            ],
        ],
    ],

    'backup2_field' => [
        'backup2_FU' => [
            'name' => '	Follow-up',
            'sub' => [
                'backup2_FU_BX' => '검체 정보',
                'backup2_FU_LAB' => '검체 획득 시점 Lab',
                'backup2_FU_ENDO' => '검체 획득 시점 검사',
                'backup2_FU_IMG' => '검체 획득 시점 영상',
            ],
        ],
    ],
];
