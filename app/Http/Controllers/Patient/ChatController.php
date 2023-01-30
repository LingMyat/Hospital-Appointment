<?php

namespace App\Http\Controllers\Patient;

use App\Models\Room;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\LiveChatMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function __contruct()
    {
        $this->middleware('patientAuth');
    }
    //show
    public function show(Request $request)
    {
        $room = Room::where('slug',$request->room_id)->first();
        $messages = LiveChatMessage::roomIn($room->id)->onlyParent()->with('room','doctor','patient','media')->get();
        $lastMessage = LiveChatMessage::orderBy('id','desc')->first();
        return view('Patient.page.Chat.live-chat',compact('room','messages','lastMessage'));
    }
    //store
    public function store(Request $request)
    {
        $room = Room::where('slug',$request->room_id)->first();
        if ($request->parent == 'true') {
            $parent = LiveChatMessage::roomIn($room->id)
            ->where('sender_id',$request->id)
            ->onlyParent()
            ->orderBy('id','desc')
            ->first();
            LiveChatMessage::create([
                'room_id'=>$room->id,
                'sender_id'=>patientAuth()->id,
                'sender_role'=>patientAuth()->role,
                'message'=>$request->message,
                'parent_id'=>$parent->id
            ]);

        } else {
            LiveChatMessage::create([
                'room_id'=>$room->id,
                'sender_role'=>patientAuth()->role,
                'sender_id'=>patientAuth()->id,
                'message'=>$request->message,
            ]);
        }
    }

    public function storeImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $msg = LiveChatMessage::create([
                'room_id'=>$request->room_id,
                'sender_id'=>patientAuth()->id,
                'sender_role'=>patientAuth()->role,
                'message'=>''
            ]);
            $path = LiveChatMessage::UPLOAD_PATH.'/'.date('Y')."/".date('m')."/";
            $fileName = uniqid().time().'.'.$request->image->extension();
            $request->image->move(public_path($path),$fileName);
            Media::create([
                'image'=>$path.$fileName,
                'mediable_id'=>$msg->id,
                'mediable_type'=>LiveChatMessage::class
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
