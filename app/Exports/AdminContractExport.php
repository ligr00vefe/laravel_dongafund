<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;

class AdminContractExport implements FromView, WithColumnWidths, WithStyles, ShouldAutoSize
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
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
        ];
    }


    public function view(): View
    {
        $contents = DB::table("view_donations_and_programs_and_payments_and_status")->get();
        $heads = [ "약정경로", "기부자명", "기부 프로그램", "기부금액", "기부방식", "결제수단", "약정일시", "약정상태", "전송상태" ];
        return view("_excel.admin.contract", [ "heads" => $heads, "contents" => $contents ]);
    }
}
