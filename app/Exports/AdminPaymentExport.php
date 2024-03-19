<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminPaymentExport implements FromView, WithColumnWidths, WithStyles, ShouldAutoSize
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
            'C' => 80,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
        ];
    }


    public function view(): View
    {
        $contents = DB::table("view_payments")->get();
        $heads = [ "연번", "웹 승인번호", "웹 약정번호", "회원번호", "증서번호", "결제수단", "승인일시", "승인금액", "결제사 거래번호", "결제상태", "연동여부" ];
        return view("_excel.admin.payment", [ "heads" => $heads, "contents" => $contents ]);
    }
}
