<?php

namespace App\Http\Controllers\Api\v1;

use App\Helper\ResponseHelper;
use App\Models\Nrc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NrcController extends Controller
{
    public function nrcCode(Request $request)
    {
        $nrc_codes = Nrc::groupBy('nrc_code')->pluck('nrc_code');
        return ResponseHelper::success($nrc_codes);
    }

    public function nrcNameMm(Request $request,$nrc_code)
    {
        $nrc_names = Nrc::where('nrc_code',$nrc_code)->get()->pluck('name_mm');
        return ResponseHelper::success($nrc_names);
    }
}
