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
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0)',
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],

        'M3' => [
            'name' => '데이터 열람 / 신청',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0)',
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],

        'MYPAGE' => [
            'name' => '마이페이지',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0)',
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],
    ],

    'sub' => [

    ],
];
