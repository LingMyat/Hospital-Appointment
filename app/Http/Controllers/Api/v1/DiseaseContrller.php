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
        $query = Disease::publish()
            ->onlyParent()
            ->with('media', 'children')
            ->active();
        if($request->search)
        {
            $query->where('name','like',"%$request->search%");
        }
        $diseases = $query->get();
        if ($request->id) {
            return ResponseHelper::success(new MainDiseaseResource(Disease::findOrFail($request->id)));
        }
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

        if ($request->id) {
            return ResponseHelper::success(new SubDiseaseResource(Disease::findOrFail($request->id)));
        }
        return ResponseHelper::success(SubDiseaseResource::collection($diseases));
    }
}
