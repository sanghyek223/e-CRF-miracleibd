<?php

namespace App\Services\Admin\Member;

use App\Models\User;
use App\Models\Hospital;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class MemberServices
 * @package App\Services
 */
class MemberServices extends AppServices
{
    public function indexService(Request $request)
    {
        $search_key = $request->search_key;
        $keyword = $request->keyword;

        $query = User::orderByDesc('sid');

        if ($request->org_code) {
            $query->where('org_code', $request->org_code);
        }

        if ($request->created_at_s) {
            $query->whereDate('created_at', '>=', $request->created_at_s);
        }

        if ($request->created_at_e) {
            $query->whereDate('created_at', '<=', $request->created_at_e);
        }

        if ($keyword) {
            switch ($search_key) {
//                case 'mobile':
//                    $query->where(function ($q) use ($keyword) {
//                        $q->where('mobile', 'like', "%{$keyword}%")
//                            ->orWhereRaw("REPLACE(mobile, '-', '') LIKE ?", ["%" . str_replace('-', '', $keyword) . "%"]);
//                    });
//                    break;

                default:
                    $query->where($search_key, 'like', "%{$keyword}%");
                    break;
            }
        }

        $list = $query->paginate(20)->appends($request->query());

        $this->data['list'] = setListSeq($list);
        $this->data['hospitals'] = Hospital::orderBy('org_name')->get();

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid;

        $user = empty($sid) ? null : User::withTrashed()->findOrFail($request->sid);
        $hospitals = Hospital::orderBy('org_name')->get();

        $this->data['user'] = $user;
        $this->data['hospitals'] = $hospitals;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'uid-check':
                return $this->uidCheck($request);

            case 'user-create':
                return $this->userCreate($request);

            case 'user-update':
                return $this->userUpdate($request);

            case 'user-delete':
                return $this->userDelete($request);

            case 'user-restore':
                return $this->userRestore($request);

            case 'pwd-reset':
                return $this->pwdReset($request);

            case 'db-change':
                return $this->dbChange($request);

            default:
                return notFoundRedirect();
        }
    }

    private function timestampsFalse($user)
    {
        $user->timestamps = false;
    }

    private function uidCheck(Request $request)
    {
        $check = User::withTrashed()->where('uid', $request->uid)->exists();

        if ($check) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '사용중인 아이디 입니다.',
                'focus' => '#uid',
                'input' => [
                    $this->ajaxActionInput('#uid', ''),
                ],
            ]);
        }

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '사용 가능합니다.',
            'data' => [
                $this->ajaxActionData('#uid', 'check', 'Y'),
            ],
        ]);
    }

    private function userCreate(Request $request)
    {
        $this->transaction();

        try {
            $user = new User();
            $user->setByAdminData($request);
            $user->save();

            $this->dbCommit('관리자 - 회원 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userUpdate(Request $request)
    {
        $this->transaction();

        try {
            $user = User::withTrashed()->findOrFail($request->sid);
            $this->timestampsFalse($user);
            $user->setByAdminData($request);
            $user->update();

            $this->dbCommit('관리자 - 회원 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true)
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    public function userDelete(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);
            $this->timestampsFalse($user);
            $user->deleted_at = now();
            $user->update();

            $this->dbCommit('관리자 - 회원 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    public function userRestore(Request $request)
    {
        $this->transaction();

        try {
            $user = User::onlyTrashed()->findOrFail($request->sid);
            $this->timestampsFalse($user);
            $user->restore();

            $this->dbCommit('관리자 - 회원 복원');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '복원 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function pwdReset(Request $request)
    {
        $this->transaction();

        try {
            $pwd = env('INITIAL_PW');

            $user = User::withTrashed()->findOrFail($request->sid);
            $this->timestampsFalse($user);
            $user->passwordChange($pwd);
            $user->initial_password = 'Y';
            $user->update();

            $this->dbCommit('관리자 - 회원 비밀번호 초기화');

            return $this->returnJsonData('alert', [
                'msg' => '초기화 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $user = User::withTrashed()->findOrFail($request->sid);
            $this->timestampsFalse($user);
            $user->{$request->field} = $request->value;
            $user->update();

            $this->dbCommit('관리자 - 회원 부분 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
