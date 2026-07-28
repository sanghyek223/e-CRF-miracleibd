<?php

return [
    'sex' => [
        '1' => '남자',
        '2' => '여자',
    ],

    'arrival' => [
        '1' => '초진',
        '2' => '내진',
    ],

    'reg_type' => [ // 등록 타입
        'base' => 'Baseline',
        'pre' => 'Pre-procedure',
        'tx' => 'Treatment',
        'outcome' => 'Outcome',
    ],

    'reg_status' => [ // 등록 상태
        'N' => [
            'class' => 'waiting',
            'name' => '입력대기',
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

    'search' => [
        'initial' => '성명(이니셜)',
        'birth' => '생년월일',
        'regist_num' => '등록코드',
    ]
];