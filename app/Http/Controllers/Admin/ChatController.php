<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Traits\MakeSlug;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use MakeSlug;
    //create
    public function create(Request $request)
    {
        return view('Admin.share.modal.room');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'image'=>'required|mimes:png,jpg,jpeg'
        ]);

        $status = $request->status?true:false;

        $image = $this->imageUpload($request->image);

        Room::create([
            'name'=>$request->name,
            'slug'=>$this->makeSlug($request->name,'rooms'),
            'image'=>$image,
            'status'=>$status
        ]);

        return redirect()->back()->with('success','Successfuly created!');
    }

    //Helper function
    private function imageUpload($img)
    {
        $path = Room::UPLOAD_PATH."/".date('Y')."/".date('m')."/";
        $fileName = uniqid().time().".".$img->extension();
        $img->move(public_path($path),$fileName);
        return ($path.$fileName);
    }
}
