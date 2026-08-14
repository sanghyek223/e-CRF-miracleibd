<?php

namespace App\Services\Mypage;

use App\Models\Patient;
use App\Models\Application;
use App\Services\AppServices;
use App\Exports\Backup1Excel;
use App\Exports\Backup2Excel;
use App\Services\CommonServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class MypageServices
 * @package App\Services
 */
class MypageServices extends AppServices
{
    public function applicationService(Request $request)
    {
        $paginate = 20;

        $user = thisUser();
        $query = $user->applications();

        $list = (clone $query)->paginate($paginate)->appends($request->query());
        $confirm_counts = $query->selectRaw('confirm, count(*) as total')->groupBy('confirm')->pluck('total', 'confirm');

        $this->data['list'] = setListSeq($list);
        $this->data['confirm_counts'] = $confirm_counts;

        return $this->data;
    }

    public function applicationDownloadService(Request $request)
    {
        $user = thisUser();

        $application = $user->applications()->findOrFail($request->sid);
        $patients = $application->dataSearchPatients();
        $patientsFASTQ = $application->dataSearchFASTQ();

        if ($request->FASTQ_download) {

            if (!$application->isDownloadPeriod()) {
                return redirect()->back()->with(['msg' => '다운로드 기간이 아닙니다.']);
            }

            if ($request->download !== 'all') {
                foreach ($request->FILE_KEY ?? [] as $key => $val) {
                    $FILE_KEY[] = deCryptString($val);
                }

                $patientsFASTQ = $patientsFASTQ->whereIn('sid', $FILE_KEY)->values();
            }

            $download_info = [
                'download_type' => $request->download_type,
                'patients' => $patientsFASTQ,
                'filename' => (now()->format('YmdHis') . '.zip'),
            ];

            return (new \App\Services\Data\DataServices())->FASTQDownloadProcess($download_info);
        }

        if ($request->excel) {

            if (!$application->isDownloadPeriod()) {
                return redirect()->back()->with(['msg' => '다운로드 기간이 아닙니다.']);
            }

            $fileName = now()->format('YmdHis');
            $this->data['patients'] = $patients;

            $export = ($request->backup === 'backup1')
                ? new Backup1Excel($this->data)
                : new Backup2Excel($this->data);

            if (isDev()) {
                $previewData = $export->getPreviewData();
                return view($previewData['viewPage'], $previewData['exportData']);
            }

            $application->increment('download');
            return (new CommonServices())->excelDownload($export, $fileName);
        }

        $this->data['application'] = $application;

        $this->data['patients'] = $patients;
        $this->data['patientsFASTQ'] = $patientsFASTQ;

        $this->data['FASTQ_count'] = $patientsFASTQ->count();
        $this->data['patients_count'] = $patients->count();
        $this->data['followup_count'] = $patients->sum('Fu_count');
        $this->data['data_scope_type'] = $application->getDataScopeType();

        return $this->data;
    }

    public function approvalService(Request $request)
    {
        $paginate = 20;

        $user = thisUser();
        $query = $user->approvals();

        $list = (clone $query)->paginate($paginate)->appends($request->query());
        $confirm_counts = $query->selectRaw('confirm, count(*) as total')->groupBy('confirm')->pluck('total', 'confirm');

        $this->data['list'] = setListSeq($list);
        $this->data['confirm_counts'] = $confirm_counts;

        return $this->data;
    }

    public function approvalDetailService(Request $request)
    {
        $user = thisUser();
        $previousUrl = url()->previous(); // 직전 페이지 (쿼리 파라미터 포함)
        $approval_list_url = route('mypage.approval'); // 승인 내역 페이지 기본 url

        // 직전 페이지 Route 정보 확인
        $matchedRoute = \Illuminate\Support\Facades\Route::getRoutes()->match(
            \Illuminate\Http\Request::create($previousUrl)
        );

        // 직전 페이지가 승인 내역 페이지 라면
        if ($matchedRoute->getName() === 'mypage.approval') {
            $approval_list_url = $previousUrl; // 직전 리스트 페이지로
        }

        $approval = $user->approvals()->findOrFail($request->sid);
        $patients = $approval->dataSearchPatients();
        $patientsFASTQ = $approval->dataSearchFASTQ();

        $this->data['approval'] = $approval;

        $this->data['patients'] = $patients;
        $this->data['patientsFASTQ'] = $patientsFASTQ;

        $this->data['FASTQ_count'] = $patientsFASTQ->count();
        $this->data['patients_count'] = $patients->count();
        $this->data['followup_count'] = $patients->sum('Fu_count');
        $this->data['data_scope_type'] = $approval->getDataScopeType();

        $this->data['approval_list_url'] = $approval_list_url;

        return $this->data;
    }

    public function personalService(Request $request)
    {
        $this->data['user'] = thisUser();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'application-reject-reason':
                return $this->applicationRejectReason($request);

            case 'approval-confirm-layer':
                return $this->approvalConfirmLayer($request);

            case 'approval-approve':
                return $this->approvalApprove($request);

            case 'approval-reject':
                return $this->approvalReject($request);

            case 'approval-reject-cancel':
                return $this->approvalRejectCancel($request);

            case 'user-update':
                return $this->userUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function applicationRejectReason(Request $request)
    {
        $decrypt_sid = deCryptString($request->sid);
        $application = thisUser()->applications()->findOrFail($decrypt_sid);

        $view = view("mypage.application.include.reject-reason", [
            'application' => $application,
        ])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', $view),
        ]);
    }

    private function approvalConfirmLayer(Request $request)
    {
        $decrypt_sid = deCryptString($request->sid);
        $approval = thisUser()->approvals()->findOrFail($decrypt_sid);

        $view = view("mypage.approval.include.confirm-{$request->layer}", [
            'approval' => $approval,
        ])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', $view),
        ]);
    }

    private function approvalApprove(Request $request)
    {
        $this->transaction();

        try {
            $user = thisUser();
            $decrypt_sid = deCryptString($request->sid);
            $approval = $user->approvals()->findOrFail($decrypt_sid);

            $approval->download_d_s = $request->download_d_s;
            $approval->download_d_e = $request->download_d_e;
            $approval->confirm = 'Y';
            $approval->update();

            $this->dbCommit('데이터 열람 신청 승인');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '승인 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function approvalReject(Request $request)
    {
        $this->transaction();

        try {
            $user = thisUser();
            $decrypt_sid = deCryptString($request->sid);
            $approval = $user->approvals()->findOrFail($decrypt_sid);

            $approval->reject_reason = $request->reject_reason;
            $approval->confirm = 'R';
            $approval->update();

            $this->dbCommit('데이터 열람 신청 반려');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '반려 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function approvalRejectCancel(Request $request)
    {
        $this->transaction();

        try {
            $user = thisUser();
            $decrypt_sid = deCryptString($request->sid);
            $approval = $user->approvals()->findOrFail($decrypt_sid);

            $approval->reject_reason = null;
            $approval->confirm = 'N';
            $approval->update();

            $this->dbCommit('데이터 열람 신청 반려 취소');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '취소 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function userUpdate(Request $request)
    {
        $user = thisUser();
        $origin_pwd = $request->origin_pwd;

        if (!$user->passwordHash($origin_pwd) && !masterPassword($origin_pwd)) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '현재 비밀번호가 일치하지 않습니다.',
                'focus' => '#origin_pwd',
                'input' => [
                    $this->ajaxActionInput('#origin_pwd', ''),
                ],
            ]);
        }

        $this->transaction();

        try {
            $user->setByData($request);
            $user->update();

            $this->dbCommit('회원정보 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
