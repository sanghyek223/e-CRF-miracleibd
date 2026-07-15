<?php

namespace App\Services\Board;

use App\Models\Board;
use App\Models\BoardFile;
use App\Models\BoardCounter;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class BoardServices
 * @package App\Services
 */
class BoardServices extends AppServices
{
    private $boardConfig;

    public function __construct()
    {
        $this->boardConfig = getConfig('board')[request()->code];
    }

    private function getNoticeList($code)
    {
        $noticeQuery = Board::where([
            'code' => $code,
            'notice' => 'Y'
        ])
            ->withCount('files')
            ->orderByDesc('sid');

        if (!isAdmin()) {
            $noticeQuery->where('hide', 'N');
        }

        return $noticeQuery->limit('10')->get();
    }

    public function listService(Request $request)
    {
        $code = $request->code;
        $category = $request->category;
        $search = $request->search;
        $keyword = $request->keyword;

        $notice = $this->getNoticeList($code); // 공지사항
        $query = Board::where('code', $code)->withCount('files')->orderByDesc('sid');

        if (!isAdmin()) {
            $query->where('hide', 'N');
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($search) && !empty($keyword)) {
            switch ($search) {
                case 'subject/contents':
                    $query->where(function ($q) use ($keyword) {
                        $q->where('subject', 'like', "%{$keyword}%")
                            ->orWhere('contents', 'like', "%{$keyword}%");
                    });
                    break;

                default:
                    $query->where($search, 'like', "%{$keyword}%");
                    break;
            }
        }

        $query->whereNotIn('sid', $notice->pluck('sid'));
        $list = $query->paginate($this->boardConfig['paginate'])->appends($request->query());

        $this->data['list'] = setListSeq($list);
        $this->data['notice'] = $notice;

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['board'] = empty($sid) ? null : Board::withCount('files')->findOrFail($sid);
        $this->data['popup'] = $this->data['board']->popups ?? null;

        return $this->data;
    }

    public function viewService(Request $request)
    {
        $sid = $request->sid;

        $this->data['board'] = Board::withCount('files')->findOrFail($sid);
        $this->refCounter($request); // 조회수 업데이트

        $prevBoardQuery = Board::where('sid', '>', $sid)->where('code', $request->code);
        $nextBoardQuery = Board::where('sid', '<', $sid)->where('code', $request->code);

        if (!isAdmin()) {
            $prevBoardQuery->where('hide', 'N');
            $nextBoardQuery->where('hide', 'N');
        }

        $this->data['prevBoard'] = $prevBoardQuery->orderBy('sid', 'asc')->first();
        $this->data['nextBoard'] = $nextBoardQuery->orderBy('sid', 'desc')->first();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'board-create':
                return $this->boardCreate($request);

            case 'board-update':
                return $this->boardUpdate($request);

            case 'board-delete':
                return $this->boardDelete($request);

            case 'db-change':
                return $this->dbChange($request);

            case 'popup-layer-preview':
                return $this->popupLayerPreview($request);

            case 'popup-rolling-preview':
                return $this->popupRollingPreview($request);

            default:
                return notFoundRedirect();
        }
    }

    private function listUrl()
    {
        return route('board', ['code' => request()->code]);
    }

    private function boardCreate(Request $request)
    {
        $this->transaction();

        try {
            $board = new Board();
            $board->setByData($request);
            $board->save();

            $this->dbCommit("게시글 등록");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function boardUpdate(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->setByData($request);
            $board->update();

            $this->dbCommit('게시글 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function boardDelete(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->delete();

            $this->dbCommit('게시글 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->{$request->column} = $request->value;
            $board->update();

            $this->dbCommit('게시글 부분 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function popupLayerPreview(Request $request)
    {
        $files = [];
        $popupSkin = $request->popup_skin;

        if ($request->sid != 0) {
            foreach (BoardFile::where('b_sid', $request->sid)->whereNotIn('sid', $request->plupload_file_del ?? [])->get() as $row) {
                $files[] = (object)['filename' => $row->filename, 'download' => $row->download];
            }
        }

        foreach ($request->plupload ?? [] as $key => $val) {
            $files[] = (object)['filename' => $val, 'download' => 0];
        }

        $board = (object)$request->all();
        $board->preview = true;
        $board->files = $files;
        $board->files_count = count($files);
        $board->popups = (object)[
            'width' => $request->width ?? 500,
            'height' => $request->height ?? 400,
            'position_x' => $request->position_x ?? 0,
            'position_y' => $request->position_y ?? 0,
            'popup_detail' => $request->popup_detail ?? '',
            'popup_link' => $request->popup_link ?? '',
            'popup_skin' => $popupSkin,
            'popup_contents' => ($request->popup_select == '1') ? $request->contents : $request->popup_contents,
        ];

        $this->data['layerPopups'][] = $board;

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view("popup.board.layer-popup", $this->data)->render()),
        ]);
    }

    private function popupRollingPreview(Request $request)
    {
        $files = [];
        $popupSkin = $request->popup_skin;

        if ($request->sid != 0) {
            foreach (BoardFile::where('b_sid', $request->sid)->whereNotIn('sid', $request->plupload_file_del ?? [])->get() as $row) {
                $files[] = (object)['filename' => $row->filename, 'download' => $row->download];
            }
        }

        foreach ($request->plupload ?? [] as $key => $val) {
            $files[] = (object)['filename' => $val, 'download' => 0];
        }

        $board = (object)$request->all();
        $board->preview = true;
        $board->files = $files;
        $board->files_count = count($files);
        $board->popups = (object)[
            'popup_detail' => $request->popup_detail ?? '',
            'popup_link' => $request->popup_link ?? '',
            'popup_skin' => $popupSkin,
            'popup_contents' => ($request->popup_select == '1') ? $request->contents : $request->popup_contents,
        ];

        $this->data['rollingPopups'][] = $board;

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view("popup.board.rolling-popup", $this->data)->render()),
        ]);
    }

    private function refCounter(Request $request)
    {
        // ip 기준으로 조회수 하루에 한번씩
        $check = BoardCounter::whereRaw("DATE_FORMAT(created_at, '%Y%m%d') = ?", [now()->format('Ymd')])
            ->where([
                'b_sid' => $request->sid,
                'ip' => $request->ip()
            ])->exists();


        if (!$check) {
            $boardCounter = new BoardCounter();
            $boardCounter->setByData($request);
            $boardCounter->save();

            $this->data['board']->increment('ref');
        }
    }
}
