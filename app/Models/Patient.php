<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patient_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [];

    protected ?array $patientConfig = null;

    protected ?array $registerConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::created(function ($patient) {
            $org_code = $patient->org_code;

            $orgPnum = self::withTrashed()->where('org_code', $org_code)->max('orgPnum') ?? 0;

            do {
                $orgPnum++;
                $patient->orgPnum = $orgPnum;
                $patient->regist_num = "{$org_code}-" . addZero($orgPnum, 4);
            } while (self::withTrashed()->where(['org_code' => $org_code, 'regist_num' => $patient->regist_num])->exists());

            $patient->saveQuietly();

            // 초기 데이터 전체 생성
            foreach ($patient->allData() as $type => $val) {
                // Follow-up 제외
                if ($type === 'FU') continue;

                foreach ($val as $tab => $model) {

                    $model->insert([
                        'regist_num' => $patient->regist_num,
                        'created_at' => now(),
                    ]);
                }
            }
        });

        static::updating(function ($patient) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $patient->last_reg_id = thisUser()->uid;
            }
        });

        // 삭제시
        static::deleting(function ($patient) {

            // 연관 데이터 전체 삭제
            foreach ($patient->allData() as $type => $val) {

                if ($type === 'FU') {
                    $val['LIST']->each(function ($row) {
                        $row->delete();
                    });
                } else {
                    foreach ($val as $tab => $model) {
                        $model->delete();
                    }
                }

            }
        });
    }

    private function patientConfig()
    {
        if (is_null($this->patientConfig)) {
            $this->patientConfig = config("site.patient");
        }

        return $this->patientConfig;
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    public function getExcelField()
    {
        return [
            'regist_num',
            'sex',
            'birth_d',
            'arrival_chk',
        ];
    }

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $user = thisUser(); // 로그인 사용자

            $this->reg_id = $user->uid;
            $this->org_code = $user->org_code;
            $this->org_name = $user->hospitalName();
        }

        $birth = "{$data['birth_d_y']}-{$data['birth_d_m']}-{$data['birth_d_d']}";

        $this->initial = $data['initial'];
        $this->sex = $data['sex'];
        $this->birth_d = $birth;
        $this->arrival_chk = $data['arrival_chk'];
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $birthArr = empty($this->birth_d) ? '' : explode('-', $this->birth_d);

        $this->birth_d_y = $birthArr[0] ?? '';
        $this->birth_d_m = $birthArr[1] ?? '';
        $this->birth_d_d = $birthArr[2] ?? '';

        return $this;
    }

    public function user() // 등록자
    {
        return $this->belongsTo(User::class, 'reg_id', 'uid')->withTrashed();
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'org_code', 'org_code')->withTrashed();
    }

    public function BaseDX()
    {
        return $this->hasOne(BaseDX::class, 'regist_num', 'regist_num');
    }

    public function BaseENDO()
    {
        return $this->hasOne(BaseENDO::class, 'regist_num', 'regist_num');
    }

    public function BaseEVN()
    {
        return $this->hasOne(BaseEVN::class, 'regist_num', 'regist_num');
    }

    public function BaseIMG()
    {
        return $this->hasOne(BaseIMG::class, 'regist_num', 'regist_num');
    }

    public function BaseLAB()
    {
        return $this->hasOne(BaseLAB::class, 'regist_num', 'regist_num');
    }

    public function BaseNTR()
    {
        return $this->hasOne(BaseNTR::class, 'regist_num', 'regist_num');
    }

    public function OutMED()
    {
        return $this->hasOne(OutMED::class, 'regist_num', 'regist_num');
    }

    public function OutOP()
    {
        return $this->hasOne(OutOP::class, 'regist_num', 'regist_num');
    }

    public function OutV()
    {
        return $this->hasOne(OutV::class, 'regist_num', 'regist_num');
    }

    public function FuLIST()
    {
        return $this->hasMany(Fu::class, 'regist_num', 'regist_num');
    }

    public function EndENDO()
    {
        return $this->hasOne(EndENDO::class, 'regist_num', 'regist_num');
    }

    public function EndMED()
    {
        return $this->hasOne(EndMED::class, 'regist_num', 'regist_num');
    }

    public function FASTQ()
    {
        return $this->hasOne(FASTQ::class, 'regist_num', 'regist_num');
    }

    public function allData($getTarget = [])
    {
        if (empty($getTarget) || in_array('BASE', $getTarget)) {
            $data['BASE'] = [
                'DX' => $this->BaseDX ?? (new BaseDX()),
                'ENDO' => $this->BaseENDO ?? (new BaseENDO()),
                'IMG' => $this->BaseIMG ?? (new BaseIMG()),
                'LAB' => $this->BaseLAB ?? (new BaseLAB()),
                'NTR' => $this->BaseNTR ?? (new BaseNTR()),
                'EVN' => $this->BaseEVN ?? (new BaseEVN()),
            ];
        }

        if (empty($getTarget) || in_array('OUT', $getTarget)) {
            $data['OUT'] = [
                'MED' => $this->OutMED ?? (new OutMED()),
                'OP' => $this->OutOP ?? (new OutOP()),
                'V' => $this->OutV ?? (new OutV()),
            ];
        }

        if (empty($getTarget) || in_array('FU', $getTarget)) {
            $data['FU'] = [
                'LIST' => $this->FuLIST ?? (new Fu()),
            ];
        }

        if (empty($getTarget) || in_array('END', $getTarget)) {
            $data['END'] = [
                'ENDO' => $this->EndENDO ?? (new EndENDO()),
                'MED' => $this->EndMED ?? (new EndMED()),
            ];
        }

        if (empty($getTarget) || in_array('FASTQ', $getTarget)) {
            $data['FASTQ'] = [
                'UPLOAD' => $this->FASTQ ?? (new FASTQ()),
            ];
        }

        return $data;
    }

    public function updateStatusBASE()
    {
        $status = 'C';
        $allBaseData = $this->allData(['BASE']);

        foreach ($allBaseData['BASE'] as $key => $rowData) {
            if ($rowData->status !== 'C') {
                $status = 'I';
                break;
            }
        }

        // Baseline 전체 입력 상태값 업데이트
        $this->status_Base = $status;
        $this->saveQuietly();
    }

    public function updateStatusOUT()
    {
        $status = 'C';
        $allBaseData = $this->allData(['OUT']);

        foreach ($allBaseData['OUT'] as $key => $rowData) {
            if ($rowData->status !== 'C') {
                $status = 'I';
                break;
            }
        }

        // Outcome 전체 입력 상태값 업데이트
        $this->status_Outcome = $status;
        $this->saveQuietly();
    }

    public function updateStatusEND()
    {
        $status = 'C';
        $allBaseData = $this->allData(['END']);

        foreach ($allBaseData['END'] as $key => $rowData) {
            if ($rowData->status !== 'C') {
                $status = 'I';
                break;
            }
        }

        // End of Study (Last F/U) 전체 입력 상태값 업데이트
        $this->status_END = $status;
        $this->saveQuietly();
    }

    public function updateStatusFASTQ()
    {
        $status = 'C';
        $allBaseData = $this->allData(['FASTQ']);

        foreach ($allBaseData['FASTQ'] as $key => $rowData) {
            if ($rowData->status !== 'C') {
                $status = 'I';
                break;
            }
        }

        // Microbiome Data Upload 전체 입력 상태값 업데이트
        $this->status_File = $status;
        $this->saveQuietly();
    }

    public function getSex()
    {
        $str = $this->patientConfig()['sex'][$this->sex ?? ''] ?? '';

        return empty($str)
            ? ''
            : mb_substr($str, 0, -1, 'UTF-8');
    }

    public function getAge()
    {
        return $this->BaseDX->IBD_age ?? '-';
    }

    public function getIBD()
    {
        return $this->BaseDX->getIBD();
    }

    public function getRegStatus($type)
    {
        switch ($type) {
            case 'BASE':
                return $this->status_Base ?? 'N';

            case 'OUT':
                return $this->status_Outcome ?? 'N';

            case 'FU':
                return $this->status_FU ?? 'N';

            case 'END':
                return $this->status_END ?? 'N';

            case 'FASTQ':
                return $this->status_File ?? 'N';

            default:
                return '';
        }
    }

    public function getRegStatusName($type)
    {
        $status = $this->getRegStatus($type);
        return $this->registerConfig()['status'][$status]['name'] ?? '';
    }

    public function getRegStatusClass($type)
    {
        $status = $this->getRegStatus($type);
        return $this->registerConfig()['status'][$status]['class'] ?? '';
    }

    public function getRegTabStatus($type, $tab)
    {
        switch ($type) {
            case 'BASE':

                switch ($tab) {
                    case 'DX':
                        return $this->BaseDX->status;

                    case 'ENDO':
                        return $this->BaseENDO->status;

                    case 'IMG':
                        return $this->BaseIMG->status;

                    case 'LAB':
                        return $this->BaseLAB->status;

                    case 'NTR':
                        return $this->BaseNTR->status;

                    case 'EVN':
                        return $this->BaseEVN->status;

                    default:
                        return '';
                }
                break;

            case 'OUT':

                switch ($tab) {
                    case 'MED':
                        return $this->OutMED->status;

                    case 'OP':
                        return $this->OutOP->status;

                    case 'V':
                        return $this->OutV->status;

                    default:
                        return '';
                }
                break;

            case 'END':

                switch ($tab) {
                    case 'ENDO':
                        return $this->EndENDO->status;

                    case 'MED':
                        return $this->EndMED->status;

                    default:
                        return '';
                }
                break;

            case 'FASTQ':
                switch ($tab) {
                    case 'UPLOAD':
                        return $this->FASTQ->status;

                    default:
                        return '';
                }
                break;

            default:
                return '';
        }
    }

    public function getRegTabStatusName($type, $tab)
    {
        $status = $this->getRegTabStatus($type, $tab);
        return $this->registerConfig()['status'][$status]['name'] ?? '';
    }

    public function getRegTabStatusClass($type, $tab)
    {
        $status = $this->getRegTabStatus($type, $tab);
        return $this->registerConfig()['status'][$status]['class'] ?? '';
    }

    public function scopeHasDataSearch($query, $search_params) // 데이터 열람신청 or 신청정보 확인시 검색 쿼리용
    {
        $query->with('FASTQ')->withCount('FuLIST as Fu_count');

        if (!empty($search_params['created_at_s'])) {
            $query->whereDate('created_at', '>=', $search_params['created_at_s']);
        }

        if (!empty($search_params['created_at_e'])) {
            $query->whereDate('created_at', '<=', $search_params['created_at_e']);
        }

        if (!empty($search_params['sex'])) {
            $query->whereIn('sex', $search_params['sex']);
        }

        $query->whereHas('BaseDX', function ($q) use ($search_params) {
            if (!empty($search_params['IBD_age_s'])) {
                $q->where('IBD_age', '>=', $search_params['IBD_age_s']);
            }

            if (!empty($search_params['IBD_age_e'])) {
                $q->where('IBD_age', '<=', $search_params['IBD_age_e']);
            }

            if (!empty($search_params['IBD_type'])) {
                $q->whereIn('IBD_type', $search_params['IBD_type']);
            }
        });
    }
}