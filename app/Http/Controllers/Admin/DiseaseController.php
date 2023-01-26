<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\MakeSlug;

class DiseaseController extends Controller
{
    use MakeSlug;
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
                'slug'=>$this->makeSlug($request->name,'diseases'),
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
                'slug'=>$this->makeSlug($request->name,'diseases'),
                'status' => $status
            ]);
            return redirect()->back()->with('success', 'Successfully updated!');
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
            $request->validate([
                'name'=>'required',
                'main_disease'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg,jfif'
            ]);
            $status = $request->status ? true : false;
            DB::beginTransaction();
            try {
                $sub_disease = Disease::create([
                    'name'=>$request->name,
                    'slug'=>$this->makeSlug($request->name,'diseases'),
                    'parent_id'=>$request->main_disease,
                    'status'=>$status
                ]);
                $image = $this->imageUpload($request->image);
                Media::create([
                    'image'=>$image,
                    'mediable_id'=>$sub_disease->id,
                    'mediable_type'=>Disease::class
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Successfully created!');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }

        public function subUpdate(Request $request,$id)
        {
            $request->validate([
                'name'=>'required',
                'main_disease'=>'required',
                'image'=>'mimes:png,jpg,jpeg,jfif'
            ]);
            $status = $request->status ? true : false;

            DB::beginTransaction();
            try {
                Disease::findOrFail($id)->update([
                    'name'=>$request->name,
                    'slug'=>$this->makeSlug($request->name,'diseases'),
                    'parent_id'=>$request->main_disease,
                    'status'=>$status
                ]);

                if($request->image){
                    $image = $this->imageUpload($request->image);
                    Media::where('mediable_id',$id)->get()->first()->update([
                        'image'=>$image
                    ]);
                }
                DB::commit();
                return redirect()->back()->with('success', 'Successfully updated!');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }

    // Sub Diseases End

    //Destroy
    public function destroy(Request $request,Disease $id)
    {
        if($id->children->isNotEmpty())
        {
            return redirect()->back()->with('error', "This Disease Have Sub Diseases You Can't Delete It!");
        }
        $id->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    //Helper function
        private function imageUpload($img)
        {
            $path = Disease::UPLOAD_PATH."/".date('Y')."/".date('m')."/";
            $fileName = uniqid().time().".".$img->extension();
            $img->move(public_path($path),$fileName);
            return ($path.$fileName);
        }

}
