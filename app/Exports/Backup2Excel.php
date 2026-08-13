<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Backup2Excel implements FromView, WithEvents
{
    private $exportData;

    private $viewPage = 'data.backup.backup2-excel';

    public function __construct($data)
    {
        $this->exportData = [
            'request' => request(),
            'patients' => setSeq($data['patients']),

            'dataConfig' => config('site.data'),
            'patientConfig' => config('site.patient'),
            'registerConfig' => config('site.register'),
        ];
    }

    public function view(): View
    {
        return view($this->viewPage, $this->exportData);
    }

    // 미리보기용 데이터 반환 (컬렉션 형태)
    public function getPreviewData()
    {
        // preview 값 추가
        $this->exportData['preview'] = true;

        return [
            'viewPage' => $this->viewPage,
            'exportData' => $this->exportData,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $event->sheet->getStyle("A:ZZ")->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('A:ZZ')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A:ZZ')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A1:ZZ1')->getFont()->setBold(true)->setSize(12);
                $event->sheet->getDelegate()->getStyle('A2:ZZ2')->getFont()->setBold(true)->setSize(12);

                // 컬럼 자동 너비 조정
                foreach ($sheet->getColumnIterator() as $column) {
                    $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
                }
            },
        ];
    }
}