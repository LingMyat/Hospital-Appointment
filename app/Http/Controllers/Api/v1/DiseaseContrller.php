<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Disease;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubDiseaseResource;
use App\Http\Resources\MainDiseaseResource;

class DiseaseContrller extends Controller
{
    //mainDisease
    public function mainDisease(Request $request)
    {
        $diseases = Disease::publish()
            ->onlyParent()
            ->with('media', 'children')
            ->active()
            ->get();
        return ResponseHelper::success(MainDiseaseResource::collection($diseases));
    }

    //subDisease
    public function subDisease(Request $request)
    {
        $diseases = Disease::publish()
            ->onlyChildren()
            ->orderBy('id', 'asc')
            ->with('media', 'parent')
            ->get();
        return ResponseHelper::success(SubDiseaseResource::collection($diseases));
    }
}
