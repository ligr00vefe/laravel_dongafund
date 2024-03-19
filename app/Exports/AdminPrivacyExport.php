<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class AdminPrivacyExport implements FromView, WithColumnWidths, WithStyles, ShouldAutoSize
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
            'D' => 60,
            'E' => 60,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
        ];

    }


    public function view(): View
    {
        $contents = DB::table("view_privacy_inquire")->orderBy("id")->get();
        $heads = [ "연번", "직번", "성명", "분류", "경로", "사유","접속날짜", "키워드", "카테고리", "아이피"];
        return view("_excel.admin.privacy", [ "heads" => $heads, "contents" => $contents ]);
    }

}
