<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Helper\ResponseHelper;
use App\Models\DoctorTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorTimeResource;

class DoctorTimeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'time_from' => 'required',
            'time_to' => 'required',
            'day_id' => 'required'
        ]);

        $time = DoctorTime::create([
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'day_id' => $request->day_id,
            'doctor_id' => $request->user()->id
        ]);
        return ResponseHelper::success(new DoctorTimeResource($time),'Successfully created!');
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'time_from' => 'required',
            'time_to' => 'required',
            'day_id' => 'required'
        ]);
        DoctorTime::findOrFail($id)->update([
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'day_id' => $request->day_id,
        ]);
        return response()->json('Successfully updated!',200);
    }

    public function destroy(Request $request,$id)
    {
        $time = DoctorTime::findOrFail($id);
        if ($time->doctor_id <> $request->user()->id) {
            return ResponseHelper::fail();
        }
        $time->delete();
        return response()->json('Successfully deleted!',200);
    }
}
