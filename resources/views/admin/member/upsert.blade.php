@extends('layouts.popup-layout')

@section('addStyle')
    <style>
        .contents {padding: 30px;}
    </style>
@endsection

@section('contents')
    <div class="popup-tit-wrap">
        <h3 class="popup-tit">회원 {{ empty($user) ? '등록' : '수정' }}</h3>
    </div>

    <div class="popup-conbox">
        <form id="member-frm" method="post" data-sid="{{ $user->sid ?? 0 }}" data-case="user-{{ empty($user) ? 'create' : 'update' }}">
            <fieldset>
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">회원 등록</caption>
                        <colgroup>
                            <col style="width:20%;">
                            <col>
                            <col style="width:20%;">
                            <col>
                        </colgroup>

                        <tbody>
                        <tr>
                            <th scope="row">기관</th>
                            <td class="text-left">
                                @empty($user)
                                    <select name="org_code" id="org_code" class="form-item">
                                        <option value="">병원을 선택하세요.</option>
                                        @foreach($hospitals as $row)
                                            <option value="{{ $row->org_code }}" {{ ($user->org_code ?? '') == $row->org_code ? 'selected' : ''  }}>{{ $row->org_name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    {{ $user->hospitalName() }}
                                @endempty
                            </td>

                            <th scope="row">아이디</th>
                            <td class="text-left">
                                @empty($user)
                                    <x-input.text field="uid" class="form-item line" data-check="N" nonespace/>
                                    <a href="javascript:void(0);" class="btn btn-small btn-type1 color-type6 ml-10 text-center" id="uid-check">중복검색</a>
                                @else
                                    {{ $user->uid }}
                                @endempty
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Password</th>
                            <td class="text-left">
                                @empty($user)
                                    (초기비밀번호 “miracleibd”)
                                @else
                                    <a href="javascript:void(0);" class="btn btn-small btn-type1 color-type4 pwd-reset">
                                        비밀번호 초기화
                                    </a>
                                @endempty
                            </td>

                            <th scope="row">성명</th>
                            <td class="text-left">
                                @empty($user)
                                    <x-input.text field="name_kr" class="form-item line" nonespace/>
                                @else
                                    {{ $user->name_kr }}
                                @endempty
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">이메일</th>
                            <td class="text-left">
                                <x-input.text field="email" :data="$user?->email" class="form-item line" nonespace/>
                            </td>

                            <th scope="row">등급</th>
                            <td class="text-left">
                                <select name="level" id="level" class="form-item">
                                    <option value="">등급 선택</option>
                                    @foreach($userConfig['level'] as $key => $val)
                                        <option value="{{ $key }}" {{ $user?->level == $key ? 'selected' : ''  }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="btn-wrap text-center">
                    <a href="javascript:self.close();" class="btn btn-type1 color-type1">취소</a>
                    <button type="submit" class="btn btn-type1 color-type2">저장</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#member-frm';
        const dataUrl = '{{ route('member.data') }}';

        $(document).on('click', '.pwd-reset', function () {
            if (confirm('초기화 하시겠습니까?')) {
                callAjax(dataUrl, {
                    case: 'pwd-reset',
                    sid: {{ $user->sid ?? 0 }},
                });
            }
        });

        $(document).on('keydown', '#uid', function () {
            $(this).data('check', 'N');
        })

        $(document).on('click', '#uid-check', function () {
            const uid = $('#uid');
            if (isEmpty(uid.val())) {
                alert('아이디를 입력해주세요.');
                uid.focus();
                return false;
            }

            callAjax(dataUrl, { case: 'uid-check', uid: uid.val() });
        });

        $(document).on('submit', form, function () {
            @empty($user)
            const org_code = $(form).find('#org_code');
            if (isEmpty(org_code.val())) {
                alert('기관을 선택해주세요.');
                org_code.focus();
                return false;
            }

            const uid = $(form).find('#uid');
            if (isEmpty(uid.val())) {
                alert('아이디를 입력해주세요.');
                uid.focus();
                return false;
            }

            if (uid.data('check') !== 'Y') {
                alert('아이디를 중복검색을 해주세요.');
                uid.focus();
                return false;
            }

            const name_kr = $(form).find('#name_kr');
            if (isEmpty(name_kr.val())) {
                alert('성명을 입력해주세요.');
                name_kr.focus();
                return false;
            }
            @endempty

            const email = $(form).find('#email');
            if (isEmpty(email.val())) {
                alert('이메일을 입력해주세요.');
                email.focus();
                return false;
            }

            if (!emailCheck(email.val())) {
                return false;
            }

            const level = $(form).find('#level');
            if (isEmpty(level.val())) {
                alert('등급을 선택해주세요.');
                level.focus();
                return false;
            }

            callMultiAjax(dataUrl, newFormData(form));
        })
    </script>
@endsection
