<?php

return [
    // ================= admin menu =================
    'main' => [
        'M1' => [
            'name' => '회원 관리',
            'route' => null,
            'param' => [],
            'url' => 'javascript:void(0);',
            'blank' => false,
            'dev' => false,
            'continue' => false,
        ],
    ],

    'sub' => [
        'M1' => [
            'S1' => [
                'name' => '전체 회원',
                'route' => 'member',
                'param' => [],
                'url' => null,
                'blank' => false,
                'dev' => false,
                'continue' => false,
            ],

            'S2' => [
                'name' => '탈퇴 회원',
                'route' => 'member',
                'param' => ['case' => 'withdrawal'],
                'url' => null,
                'blank' => false,
                'dev' => false,
                'continue' => false,
            ],
        ],
    ]
];
