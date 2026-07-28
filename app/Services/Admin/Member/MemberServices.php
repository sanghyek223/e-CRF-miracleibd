<?php

namespace App\Services\Admin\Member;

use App\Models\User;
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

        if ($keyword) {
            switch ($search_key) {
                case 'mobile':
                    $query->where(function ($q) use ($keyword) {
                        $q->where('mobile', 'like', "%{$keyword}%")
                            ->orWhereRaw("REPLACE(mobile, '-', '') LIKE ?", ["%" . str_replace('-', '', $keyword) . "%"]);
                    });
                    break;

                default:
                    $query->where($search_key, 'like', "%{$keyword}%");
                    break;
            }
        }

        $list = $query->paginate(20)->appends($request->query());

        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['user'] = User::findOrFail($request->sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'user-update':
                return $this->userUpdate($request);

            case 'user-delete':
                return $this->userDelete($request);

            case 'db-change':
                return $this->dbChange($request);

            default:
                return notFoundRedirect();
        }
    }

    private function userUpdate(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);
            $user->setByData($request);
            $user->update();

            $this->dbCommit('관리자 - 회원정보 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회원정보가 수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
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
            $user->delete();

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

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $user = User::findOrFail($request->sid);
            $user->{$request->field} = $request->value;
            $user->update();

            $this->dbCommit('관리자 회원정보 부분 수정');

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
