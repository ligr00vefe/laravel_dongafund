<?php

namespace App\Exports;

use App\Models\ViewPrivacyAgreements;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminPrivacyAgreementExport implements FromView, WithColumnWidths, WithStyles, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function styles(Worksheet $sheet)
    {
//        return [
//            2    => ['font' => ['size' => 14]],
//        ];
    }

    public function columnWidths(): array
    {

        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 30,
            'E' => 150,
            'F' => 30,
        ];

    }


    public function view(): View
    {
        $contents = DB::table("view_privacy_agreements")->get();
        $heads = [ "연번", "기부자명", "전화번호", "분류", "내용", "동의날짜" ];
        return view("_excel.admin.agreement", [ "heads" => $heads, "contents" => $contents ]);
    }
}
