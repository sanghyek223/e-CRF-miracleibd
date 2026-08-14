<?php

namespace App\Services\Data;

use App\Models\Patient;
use App\Models\Hospital;
use App\Models\Application;
use App\Exports\Backup1Excel;
use App\Exports\Backup2Excel;
use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use STS\ZipStream\Facades\Zip;

/**
 * Class DataServices
 * @package App\Services
 */
class DataServices extends AppServices
{
    public function indexService(Request $request)
    {
        $user = thisUser();
        $my_org_code = $user->org_code;
        $search_params = $request->all();

        // 나의 (같은 기관 코드) 환자 리스트
        $myQuery = $user->patients()->hasDataSearch($search_params);
        $myPatients = (clone $myQuery)->get();
        $myPatientsFASTQ = $myQuery->withWhereHas('FASTQ', fn($q) => $q->hasFile())->get();

        if ($request->FASTQ_download) {

            $filename = (now()->format('YmdHis') . '.zip');
            $download_type = $request->download_type;

            if ($download_type !== 'all') {
                $FILE_KEY = $request->FILE_KEY;
                $decrypt_FILE_KEY = deCryptString($FILE_KEY);

                $myPatientsFASTQ = $myPatientsFASTQ->where('sid', $decrypt_FILE_KEY)->values();
            }

            $download_info = [
                'download_type' => $download_type,
                'patients' => $myPatientsFASTQ,
                'filename' => $filename,
            ];

            return $this->FASTQDownloadProcess($download_info);
        }

        if ($request->excel) {

            $filename = now()->format('YmdHis');
            $this->data['patients'] = $myPatients;

            $export = ($request->backup === 'backup1')
                ? new Backup1Excel($this->data)
                : new Backup2Excel($this->data);

            if (isDev()) {
                $previewData = $export->getPreviewData();
                return view($previewData['viewPage'], $previewData['exportData']);
            }

            return (new CommonServices())->excelDownload($export, $filename);
        }

        // 본인 기관 제외 열람 신청 할 기관 및 데이터
        $hospitals = Hospital::orderBy('org_name')->where('org_code', '!=', $my_org_code)->get();
        $query = Patient::where('org_code', '!=', $my_org_code)->hasDataSearch($search_params);

        if (!empty($search_params['org_code'])) {
            $query->whereIn('org_code', $search_params['org_code']);
        }

        // 검색 데이터 기준 group data count
        $data = $query->selectRaw('org_code, count(*) as total')->groupBy('org_code')->pluck('total', 'org_code');

        $this->data['data'] = $data;
        $this->data['hospitals'] = $hospitals;

        $this->data['myPatients'] = $myPatients;
        $this->data['myPatientsFASTQ'] = $myPatientsFASTQ;

        $this->data['backup1_count'] = $myPatients->count();
        $this->data['backup2_count'] = $myPatients->sum('Fu_count');

        return $this->data;
    }

    public function applicationService(Request $request)
    {
        $search_url = $request->search_url;
        $application_org_code = $request->application_org_code;
        $parse_data_query_string = parse_url($search_url, PHP_URL_QUERY);

        parse_str($parse_data_query_string, $data_params); // parameter 추출

        // 데이터 열람 신청 기관
        $hospital = Hospital::orderBy('org_name')->where('org_code', $application_org_code)->firstOrFail();

        // 신청 데이터 기준 환자 쿼리 기본
        $query = $hospital->patients()->hasDataSearch($data_params);

        // 환자 리스트
        $patients = (clone $query)->orderByDesc('sid')->get();

        // 환자 리스트 에서 파일 업로드 있는 데이터만
        $patientsFASTQ = $query->withWhereHas('FASTQ', fn($q) => $q->hasFile())->get();

        $this->data['search_url'] = $search_url;
        $this->data['search_params'] = [ // 검색 파라미터 값 노출 & 데이터 저장용
            'application_org_code' => $application_org_code,

            'created_at_s' => $data_params['created_at_s'] ?? '',
            'created_at_e' => $data_params['created_at_e'] ?? '',

            'sex' => $data_params['sex'] ?? [],

            'IBD_age_s' => $data_params['IBD_age_s'] ?? '',
            'IBD_age_e' => $data_params['IBD_age_e'] ?? '',

            'IBD_type' => $data_params['IBD_type'] ?? '',
        ];

        $this->data['hospital'] = $hospital;
        $this->data['patients'] = $patients;
        $this->data['patientsFASTQ'] = $patientsFASTQ;

        $this->data['backup1_count'] = $patients->count();
        $this->data['backup2_count'] = $patients->sum('Fu_count');

        return $this->data;
    }

    public function FASTQDownloadProcess($download_info)
    {
        $filename = (new CommonServices())->filenameRegx($download_info['filename']);
        $uploadConfig = config('site.register.FASTQ.UPLOAD');

        $zip = Zip::create($filename);

        foreach ($download_info['patients'] as $patient) {
            $FASTQ = $patient->FASTQ;
            $dir_name = $patient->regist_num;

            foreach ($uploadConfig['file'] as $key => $val) {
                if (!empty($FASTQ->{$val['upload_name']})) {
                    $path = public_path($FASTQ->getUploadPath($key));

                    if (File::exists($path)) {
                        $zip->add($path, $dir_name . '/' . $FASTQ->{$val['origin_name']});
                    }
                }
            }
        }

        return $zip;
    }

    public function FASTQDownloadProcessBack($download_info)
    {
        if ($download_info['patients']->count() === 0) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '다운로드할 항목이 없습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        }

        $job_id = (string)Str::uuid();

        $zipDirectory = storage_path('app/zipArchive');

        if (!File::exists($zipDirectory)) {
            File::makeDirectory($zipDirectory, 0755, true);
        }

        $zipFileName = (new CommonServices())->filenameRegx($download_info['filename']);
        $zipRealPath = "{$zipDirectory}/{$zipFileName}";

        $zip = new \ZipArchive();

        $open = $zip->open($zipRealPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        if ($open !== true) {
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => "Zip 파일 생성 실패 (code: {$open})",
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        }

        // 파일 등록 + 전체 용량 계산
        $total_size = 0;
        $file_count = 0;
        $uploadConfig = config('site.register.FASTQ.UPLOAD');

        foreach ($download_info['patients'] as $patient) {
            $FASTQ = $patient->FASTQ;
            $dir_name = $patient->regist_num;

            foreach ($uploadConfig['file'] as $key => $val) {
                if (!empty($FASTQ->{$val['upload_name']})) {
                    $path = public_path($FASTQ->getUploadPath($key));

                    if (File::exists($path)) {
                        $zip->addFile($path, $dir_name . '/' . $FASTQ->{$val['origin_name']});
                        $total_size += File::size($path);
                        $file_count++;
                    }
                }
            }
        }

        $zip->close();

        $progressView = view('data.include.download-progress', [
            'file_count' => $file_count,
            'total_size' => $total_size,
        ])->render();

        $this->setJsonData('log', '압축 완료.');

        $this->setJsonData('file_data', [
            'job_id' => $job_id,
            'file_name' => $zipFileName,
            'download_type' => $download_info['download_type'],
        ]);

        $this->setJsonData('remove', [
            $this->ajaxActionHtml('.progress-div-info', $progressView),
        ]);

        if ($download_info['download_type'] === 'all') {
            $this->setJsonData('before', [
                $this->ajaxActionHtml('.download-FASTQ-tbl-wrap', $progressView),
            ]);
        } else {
            $this->setJsonData('choice_progress', $progressView);
        }

        Cache::put("fastq_progress_{$job_id}", [
            'u_sid' => thisPK(), // 본인 요청 환인용
            'status' => 'done',
            'file_name' => $zipFileName,
            'real_path' => $zipRealPath,
            'download_type' => $download_info['download_type'],
        ], now()->addHours(3));

        return $this->returnJson();
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'application-create':
                return $this->applicationCreate($request);

            default:
                return notFoundRedirect();
        }
    }

    public function applicationCreate(Request $request)
    {
        $this->transaction();

        try {
            $application = new Application();
            $application->setByData($request);
            $application->save();

            $this->dbCommit('타 기관 데이터 신청 접수');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '신청 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $request->search_url)
            ]);
        } catch (\Exceptio $e) {
            return $this->dbRollback($e);
        }
    }
}