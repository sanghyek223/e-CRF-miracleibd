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

    'year_start' => 2000,
    'year_end' => now()->year,

    'yn' => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'yn2' => [
        '0' => '아니오',
        '1' => '예',
    ],

    'BASE' => [
        'DX' => [
            'IBD_type' => [ // IBD Type
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

        'IMG' => [
            'b_img_sev' => [ // Severity
                '0' => 'No',
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
            ],

            'b_inv_seg' => [ // Involved segment (checkbox key => 필드명, value => 1 고정)
                'b_inv_seg1' => 'ileum',
                'b_inv_seg2' => 'terminal ileum',
                'b_inv_seg3' => 'IC valve',
                'b_inv_seg4' => 'Cecum',
                'b_inv_seg5' => 'A colon',
                'b_inv_seg6' => 'T colon',
                'b_inv_seg7' => 'D colon',
                'b_inv_seg8' => 'S colon',
                'b_inv_seg9' => 'Rectum',
            ],

            'b_fistula' => [ // Fistula
                '1' => 'Perianal',
                '2' => 'Enteroenteric',
                '31' => 'Enterocolic',
            ],

            'b_stricture' => [ // Stricture
                '0' => 'No',
                '1' => 'Present',
            ],

            'b_abscess' => [ // Abscess
                '0' => 'No',
                '1' => 'Present',
            ],
        ],

        'LAB' => [
            'b_lab_IgG' => [ // ASCA IgG
                '0' => 'negative (<10)',
                '1' => 'positive',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_IgA' => [ // ASCA IgA
                '0' => 'negative (<10)',
                '1' => 'positive',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_IgG_cat' => [ // ASCA IgG 분류
                '0' => '0~4.9',
                '1' => '5~14.9',
                '2' => '15~',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_IgA_cat' => [ // ASCA IgA 분류
                '0' => '0~4.9',
                '1' => '5~14.9',
                '2' => '15~',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_ASCA_total' => [ // ASCA Total 분류
                '0' => '0~4.9',
                '1' => '5~14.9',
                '2' => '15~',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_ANCA' => [ // ANCA
                '0' => 'negative (<3.5)',
                '1' => 'positive (>5)',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_Cdiff_toxin' => [ // C.difficile toxin
                '0' => 'negative',
                '1' => 'positive',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_Cdiff_CPR' => [ // C.difficile PCR
                '0' => 'negative',
                '1' => 'positive',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_bi_toxin' => [ // binary toxin
                '0' => 'not detected',
                '1' => 'detected',
                '9' => 'N/A (획득되지 않음)',
            ],

            'b_lab_TcDc_del' => [ // TcDc deletion
                '0' => 'not detected',
                '1' => 'detected',
                '9' => 'N/A (획득되지 않음)',
            ],
        ],

        'NTR' => [
            'b_NTR_Tx_k' => [ // 영양 치료 병행 방식
                '0' => '없음 (일반식)',
                '1' => 'EEN (6주 이상)',
                '2' => 'CDED (phase 1 6주 완료 / 12주 완료)',
                '3' => 'CDED + PEN',
                '4' => '기타 식이요법',
            ],

            'b_NTR_Tx_stop_k' => [ // 영양 치료 중단 사유
                '1' => '맛 거부감',
                '2' => '위장 증상 악화',
                '3' => '기타',
            ],

            'b_NTR_PF' => [ // 가공식품 섭취
                '1' => '매일',
                '2' => '주 3~4회',
                '3' => '월 3~4회',
                '4' => '거의 먹지 않음',
            ],
        ],

        'EVN' => [
            'b_EVN_E1q' => [ // 일상 활동 정도
                '1' => '움직임이 극히 적음',
                '2' => '대부분의 시간을 앉아서 하는 정적 활동으로 보냄',
                '3' => '주로 앉아서 보내지만 서서 하는 작업, 통근, 물건구입, 집안일, 가벼운 운동 등',
                '4' => '주로 서서 하는 작업 종사, 또는 운동 등 활발한 여가 활동',
                '5' => '직접 기술',
            ],

            'b_EVN_B2q' => [ // 2. 어머니가 본인을 출산할 때 어떤 방법으로 하셨나요?
                '0' => '질식분만',
                '1' => '제왕절개 (수술)',
            ],

            'b_EVN_PH2q' => [ // 2. 다음 중 염증성장질환 진단 전 경험한 감염증을 모두 선택해 주세요. (checkbox key => 필드명, value => 1 고정)
                'b_EVN_PH2q_1' => '홍역',
                'b_EVN_PH2q_2' => '백일해',
                'b_EVN_PH2q_3' => '풍진',
                'b_EVN_PH2q_4' => '수두',
                'b_EVN_PH2q_5' => '볼거리',
                'b_EVN_PH2q_6' => '소아마비(폴리오)',
            ],

            'b_EVN_PH3q' => [ // 3. 다음 중 어린 시절 접종 받았던 백신을 모두 선택해 주세요. (checkbox key => 필드명, value => 1 고정)
                'b_EVN_PH3q_1' => 'BCG',
                'b_EVN_PH3q_2' => '백일해',
                'b_EVN_PH3q_3' => '홍역',
                'b_EVN_PH3q_4' => '풍진',
                'b_EVN_PH3q_5' => '디프테리아',
                'b_EVN_PH3q_6' => '파상풍',
                'b_EVN_PH3q_7' => '소아마비(폴리오)',
            ],

            'b_EVN_P1q' => [ // 1-1. 현재 기르고 있는 반려 동물을 모두 선택해 주세요. (checkbox key => 필드명, value => 1 고정)
                'b_EVN_P1q_1' => '개',
                'b_EVN_P1q_2' => '고양이',
                'b_EVN_P1q_3' => '설치류',
                'b_EVN_P1q_4' => '새',
                'b_EVN_P1q_5' => '물고기',
                'b_EVN_P1q_6' => '기타',
            ],

            'b_EVN_P2q' => [ // 2-1. 어린 시절 길렀던 반려 동물을 모두 선택해 주세요. (checkbox key => 필드명, value => 1 고정)
                'b_EVN_P2q_1' => '개',
                'b_EVN_P2q_2' => '고양이',
                'b_EVN_P2q_3' => '설치류',
                'b_EVN_P2q_4' => '새',
                'b_EVN_P2q_5' => '물고기',
                'b_EVN_P2q_6' => '기타',
            ],

            'b_EVN_FH5q' => [ // 5. 나의 출생지는 어디인가요?
                '1' => '대도시 (인구 50만명 이상)',
                '2' => '중·소도시',
                '3' => '농촌, 도서지역',
            ],

            'b_EVN_M2q_1' => [ // 2-1. 진단 시점 이전 항생제 치료 횟수는 얼마입니까?
                '1' => '1-3회',
                '2' => '4-5회',
                '3' => '6회 이상',
            ],

            'b_EVN_S2q' => [ // 2. 현재 주/야간 교대 근무를 하고 있습니까?
                '0' => '아니오',
                '1' => '예',
                '2' => '3교대 이상',
            ],

            'b_EVN_C2q' => [ // 2. COVID 19 백신 접종 횟수는?
                '0' => '미접종',
                '1' => '1회',
                '2' => '2회',
                '3' => '3회',
                '4' => '4회',
                '5' => '5회 이상',
            ],
        ],
    ],

    'OUT' => [
        'MED' => [
            'out_bio1_cat' => [ // 추가 투약 - 생물학적제제 – 1차 약제 종류
                '1' => 'infliximab',
                '2' => 'vedolizumab',
                '3' => 'Ustekinumab',
                '4' => 'tofacitinib',
                '5' => 'filgotinib',
                '6' => 'Upadacitinib',
                '7' => 'ozanimod',
                '8' => 'adalimumab',
                '9' => 'Golimumab',
                '10' => 'Risankizumab',
                '11' => 'Vixarelimab',
                '12' => 'mirikizumab',
            ],

            'out_bio2_cat' => [ // 추가 투약 - 생물학적제제 – 2차 약제 종류
                '1' => 'infliximab',
                '2' => 'vedolizumab',
                '3' => 'Ustekinumab',
                '4' => 'tofacitinib',
                '5' => 'filgotinib',
                '6' => 'Upadacitinib',
                '7' => 'ozanimod',
                '8' => 'adalimumab',
                '9' => 'Golimumab',
                '10' => 'Risankizumab',
                '11' => 'Vixarelimab',
                '12' => 'mirikizumab',
            ],

            'out_bio3_cat' => [ // 추가 투약 - 생물학적제제 – 3차 약제 종류
                '1' => 'infliximab',
                '2' => 'vedolizumab',
                '3' => 'Ustekinumab',
                '4' => 'tofacitinib',
                '5' => 'filgotinib',
                '6' => 'Upadacitinib',
                '7' => 'ozanimod',
                '8' => 'adalimumab',
                '9' => 'Golimumab',
                '10' => 'Risankizumab',
                '11' => 'Vixarelimab',
                '12' => 'mirikizumab',
            ],

            'out_bio4_cat' => [ // 추가 투약 - 생물학적제제 – 4차 약제 종류
                '1' => 'infliximab',
                '2' => 'vedolizumab',
                '3' => 'Ustekinumab',
                '4' => 'tofacitinib',
                '5' => 'filgotinib',
                '6' => 'Upadacitinib',
                '7' => 'ozanimod',
                '8' => 'adalimumab',
                '9' => 'Golimumab',
                '10' => 'Risankizumab',
                '11' => 'Vixarelimab',
                '12' => 'mirikizumab',
            ],
        ],

        'OP' => [
            'op_list_max' => 10,
        ],

        'V' => [
            'v_list_max' => 10,

            'out_visit_k' => [ // ER/Admission 구분
                '1' => 'ER',
                '2' => 'Admission',
            ],
        ],
    ],

    'FU' => [

    ],

    'END' => [
        'ENDO' => [
            'end_UC_l' => [ // UC - Location
                '1' => 'E1 (proctitis)',
                '2' => 'E2 (left-sided)',
                '3' => 'E3 (extensive)',
                '9' => 'Undeterminate',
            ],

            'end_UC_sens' => [ // UC - Severity
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
                '9' => 'Undeterminate',
            ],

            'end_CD_l' => [ // CD - Location
                '1' => 'L1 (ileal)',
                '2' => 'L2 (colonic)',
                '3' => 'L3 (ileocolonic)',
                '9' => 'Undeterminate',
            ],

            'end_CD_sens' => [ // CD - Severity
                '1' => 'mild',
                '2' => 'moderate',
                '3' => 'severe',
                '9' => 'Undeterminate',
            ],

            'end_CD_behav' => [ // CD - Behavior
                '1' => 'B1',
                '2' => 'B2 (stricturing)',
                '3' => 'B3 (penetrating)',
            ],
        ],

        'MED' => [
            'end_bio_cat' => [ // 생물학제제 약제 종류
                '1' => 'infliximab',
                '2' => 'vedolizumab',
                '3' => 'Ustekinumab',
                '4' => 'tofacitinib',
                '5' => 'filgotinib',
                '6' => 'Upadacitinib',
                '7' => 'ozanimod',
                '8' => 'adalimumab',
                '9' => 'Golimumab',
                '10' => 'Risankizumab',
                '11' => 'Vixarelimab',
                '12' => 'mirikizumab',
            ],
        ],
    ],

    'FASTQ' => [
        'UPLOAD' => [

        ],
    ],
];