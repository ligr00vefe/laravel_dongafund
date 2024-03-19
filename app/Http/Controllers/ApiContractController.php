<?php

namespace App\Http\Controllers;

use App\api\Contract;
use Illuminate\Http\Request;

class ApiContractController extends Controller
{
    public function incomplete(Request $request)
    {
        return Contract::incomplete($request);
    }
}
