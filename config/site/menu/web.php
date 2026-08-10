<?php

return [
    // ================= web menu =================
    'main' => [
        'M1' => [
            'name' => '신규 대상자 등록',
            'route' => 'patient.upsert',
            'param' => [],
            'url' => null,
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],

        'M2' => [
            'name' => '전체 대상자 리스트',
            'route' => 'register',
            'param' => [],
            'url' => null,
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],

        'M3' => [
            'name' => '데이터 열람 / 신청',
            'route' => 'data',
            'param' => [],
            'url' => null,
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],

        'MYPAGE' => [
            'name' => '마이페이지',
            'route' => 'mypage.application',
            'param' => [],
            'url' => null,
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],
    ],

    'sub' => [
        'MYPAGE' => [
            'S1' => [
                'name' => '신청 내역',
                'route' => 'mypage.application',
                'param' => [],
                'url' => null,
                'blank' => false,
                'dev' => false,
                'continue' => false,
            ],

            'S2' => [
                'name' => '승인 내역',
                'route' => 'mypage.approval',
                'param' => [],
                'url' => null,
                'blank' => false,
                'dev' => false,
                'continue' => false,
            ],

            'S3' => [
                'name' => '회원 정보',
                'route' => 'mypage.personal',
                'param' => [],
                'url' => null,
                'blank' => false,
                'dev' => false,
                'continue' => false,
            ],
        ],
    ],
];
