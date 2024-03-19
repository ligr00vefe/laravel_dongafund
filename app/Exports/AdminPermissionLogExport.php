<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class AdminPermissionLogExport implements FromView, WithColumnWidths, WithStyles, ShouldAutoSize
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
        $contents = DB::table("view_admin_permission_logs")->get();
        $heads = [ "연번", "변경사항", "관리자 직번", "관리자명", "부여권한", "변경일자" ];
        return view("_excel.admin.adminPermissionLogs", [ "heads" => $heads, "contents" => $contents ]);
    }
}
