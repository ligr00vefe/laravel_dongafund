<?php

namespace App\Http\Controllers;

use App\Exports\AdminContractExport;
use App\Exports\AdminPaymentExport;
use App\Exports\AdminPermissionLogExport;
use App\Exports\AdminPrivacyAgreementExport;
use App\Exports\AdminPrivacyExport;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminExcelExportController extends Controller
{
    public function contract(Request $request)
    {
        return Excel::download(new AdminContractExport($request), "발전기금_약정서_". date("Y-m-d") .".xlsx");
    }

    public function adminPermissionLogs(Request $request)
    {
        return Excel::download(new AdminPermissionLogExport($request), "발전기금_관리자_권한변경_로그_". date("Y-m-d") .".xlsx");
    }

    public function privacy(Request $request)
    {
        return Excel::download(new AdminPrivacyExport($request), "발전기금_관리자_개인정보_조회_내역_". date("Y-m-d") . ".xlsx");
    }

    public function agreement(Request $request)
    {
        return Excel::download(new AdminPrivacyAgreementExport($request), "발전기금_관리자_개인정보_동의_내역_". date("Y-m-d") . ".xlsx");
    }

    public function payment(Request $request)
    {
        return Excel::download(new AdminPaymentExport($request), "발전기금_관리자_결제_승인_내역_". date("Y-m-d") . ".xlsx");
    }
}
