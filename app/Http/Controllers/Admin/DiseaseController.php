<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    // Main Diseases Start
        public function mainCreate(Request $request)
        {
            return view('Admin.share.modal.main-disease');
        }

        public function mainStore(Request $request)
        {
            $request->validate([
                'name'=>'required|max:100'
            ]);
            $status = $request->status ? true : false;
            Disease::create([
                'name'=>$request->name,
                'status'=>$status
            ]);

            return redirect()->back()->with('success', 'Successfully created!');
        }

        public function mainUpdate(Request $request,$id)
        {
            $request->validate([
                'name'=>'required|max:100'
            ]);
            $status = $request->status ? true : false;
            $mainDisease = Disease::findOrFail($id);
            $mainDisease->update([
                'name' => $request->name,
                'status' => $status
            ]);
            return redirect()->back()->with('success', 'Successfully updated!');
        }

        public function mainDestroy(Request $request,$id)
        {
            Disease::findOrFail($id)->update([
                'status' => false,
                'deleted_at' => now()
            ]);

            return redirect()->back()->with('success', 'Successfully deleted!');
        }
    // Main Diseases End

    // Sub Diseases Start
    public function subCreate(Request $request)
    {
        $mainDiseases = Disease::publish()
                        ->onlyParent()
                        ->with('media','children')
                        ->get();
        return view('Admin.share.modal.sub-disease',compact('mainDiseases'));
    }

    public function subStore(Request $request)
    {
        dd($request->all());
    }
}
