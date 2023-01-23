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
            Disease::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        }
    // Main Diseases End
}
