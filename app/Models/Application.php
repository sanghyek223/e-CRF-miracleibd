<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'fastq_file' => 'array',
        'search_params' => 'array',

        'download_d_s' => 'date',
        'download_d_e' => 'date',
        'confirm_at' => 'datetime',
        
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $dataConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($application) {
            $user = thisUser();

            $application->u_sid = $user->sid;
            $application->org_code = $user->org_code;
        });

        static::saving(function ($application) {
            $user = thisUser();

            if ($application->isDirty('confirm')) {
                $is_ready = ($application->confirm == 'N');

                $application->confirm_at = ($is_ready) ? null : now();
                $application->application_u_sid = ($is_ready) ? null : $user->sid;
            }
        });
    }

    private function dataConfig()
    {
        if (is_null($this->dataConfig)) {
            $this->dataConfig = config("site.data");
        }

        return $this->dataConfig;
    }

    public function setByData($data)
    {
        $dataConfig = $this->dataConfig();
        $search_params = json_decode($data->search_params, true);

        // 데이터 다운로드 희망 날짜
        $download_d = "{$data['download_d_y']}-{$data['download_d_m']}-{$data['download_d_d']}";
        $download_d_replace = str_replace('-', '', $download_d);

        if (empty($download_d_replace)) {
            $download_d = '';
        }

        $this->application_org_code = $search_params['application_org_code'];

        $this->applicant = $data['applicant'];
        $this->reason = $data['reason'];

        $this->download_d_s = $download_d;
        $this->download_d_e = Carbon::parse($download_d)->addDays(7)->format('Y-m-d'); // 다운로드 기간 종료일 => 다운로드 시작일 +7일

        $this->data_scope = $data['data_scope'];

        // IBD Type 분류별 정의
        $is_data_scope_file = in_array($this->data_scope, $dataConfig['data_scope_file']);
        $is_data_scope_row = in_array($this->data_scope, $dataConfig['data_scope_row']);

        // FASTQ 파일 선택
        $this->fastq_file = $is_data_scope_file ? $data['fastq_file'] : null;

        // Raw data 선택
        foreach ($dataConfig['backup1_field'] as $key => $val) {

            if (empty($val['sub'])) {
                $this->{$key} = $is_data_scope_row ? $data[$key] : 'N';
            } else {

                foreach ($val['sub'] as $sub_key => $sub_val) {
                    $this->{$sub_key} = $is_data_scope_row ? $data[$sub_key] : 'N';
                }
            }
        }

        foreach ($dataConfig['backup2_field'] as $key => $val) {

            if (empty($val['sub'])) {
                $this->{$key} = $is_data_scope_row ? $data[$key] : 'N';
            } else {

                foreach ($val['sub'] as $sub_key => $sub_val) {
                    $this->{$sub_key} = $is_data_scope_row ? $data[$sub_key] : 'N';
                }
            }
        }

        $this->search_params = $search_params;
    }

    public function user() // 실제 데이터 열람 신청 신청한 회원
    {
        return $this->belongsTo(User::class, 'u_sid')->withTrashed();
    }

    public function applicationUser() // 데이터 열람 신청 confirm 한 사용자
    {
        return $this->belongsTo(User::class, 'application_u_sid')->withTrashed();
    }

    public function getApplicationUserName()
    {
        return $this->applicationUser->name_kr;
    }

    public function hospital() // 신청 기관
    {
        return $this->belongsTo(Hospital::class, 'org_code', 'org_code');
    }

    public function applicationHospital() // 데이터 열람 신청한 기관
    {
        return $this->belongsTo(Hospital::class, 'application_org_code', 'org_code');
    }

    public function getHosName() // 신청 기관명
    {
        return $this->hospital->org_name ?? '';
    }

    public function getApplicationHosName() // 데이터 열람 신청한 기관명
    {
        return $this->applicationHospital->org_name ?? '';
    }

    public function getDataScope()
    {
        return $this->dataConfig()['data_scope'][$this->data_scope ?? ''] ?? '';
    }

    public function getDataScopeType()
    {
        $dataConfig = $this->dataConfig();

        return [
            'data_scope_file' => in_array($this->data_scope, $dataConfig['data_scope_file']),
            'data_scope_row' => in_array($this->data_scope, $dataConfig['data_scope_row']),
        ];
    }

    public function getConfirm()
    {
        return $this->dataConfig()['confirm'][$this->confirm ?? ''] ?? '';
    }

    public function getConfirmClass()
    {
        switch ($this->confirm) {
            case 'R': // 반려
                return 'reject';

            case 'Y': // 승인
                return 'complete';

            default: // 대기
                return 'ing';
        }
    }

    public function confirmComplete()
    {
        return ($this->confirm === 'Y');
    }

    public function confirmReject()
    {
        return ($this->confirm === 'R');
    }

    public function confirmReady()
    {
        return ($this->confirm === 'N');
    }

    public function getDownloadDate($format = 'Y-m-d')
    {
        $download_d_s = $this->download_d_s->format($format);
        $download_d_e = $this->download_d_e->format($format);

        return "{$download_d_s} ~ {$download_d_e}";
    }

    public function isDownloadPeriod()
    {
        $now = now();
        $start = $this->download_d_s->copy()->startOfDay();
        $end = $this->download_d_e->copy()->endOfDay();

//        if ($now->between($start, $end)) {
//            return '다운로드 기간';
//        } elseif ($now->lt($start)) {
//            return '예정';
//        } else {
//            return '종료';
//        }

        return $now->between($start, $end);
    }

    public function isDownload()
    {
        return ($this->download === 0 ? 'X' : 'O');
    }

    public function isDownloadClass()
    {
        return ($this->download === 0 ? 'text-red' : 'text-skyblue');
    }

    public function dataSearchDefaultQuery()
    {
        return Patient::where('org_code', $this->application_org_code)->hasDataSearch($this->search_params);
    }

    public function dataSearchCount() // 데이터 열람신청 or 신청정보 로 확인하는 신청 건수
    {
        return $this->dataSearchDefaultQuery()->count();
    }

    public function dataSearchPatients() // 데이터 열람신청 or 신청정보 로 확인하는 신청 환자들
    {
        return $this->dataSearchDefaultQuery()->get();
    }

    public function dataSearchFASTQCount() // 데이터 열람신청 or 신청정보 로 확인하는 신청 환자들 중 FASTQ 파일 다운로드 신청 건수
    {
        return count($this->fastq_file ?? []);
    }

    public function dataSearchFASTQ() // 데이터 열람신청 or 신청정보 로 확인하는 신청 환자들 중 FASTQ 파일 다운로드 신청 환자
    {
        return $this->dataSearchDefaultQuery()
            ->withWhereHas('FASTQ', function ($q) {
                $q->hasFile()->whereIn('sid', $this->fastq_file);
            })->get();
    }
}
