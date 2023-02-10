<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Room;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Models\LiveChatMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Http\Resources\RoomMessageResource;
use App\Http\Resources\RoomMessageSenderResource;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::active();
        if($request->search)
        {
            $query->where('name','like',"%$request->search%");
        }
        $rooms = $query->get();
        return ResponseHelper::success(RoomResource::collection($rooms));
    }

    public function roomMessages(Request $request,$id)
    {
        $room = Room::findOrFail($id);
        $messages = LiveChatMessage::roomIn($id)->onlyParent()->with('room','patient','doctor','media')->get();
        $lastMessage = LiveChatMessage::orderBy('id','desc')->first();
        $data = [
            'room'=>new RoomResource($room),
            'messages'=>RoomMessageResource::collection($messages),
            'last_sender'=>$lastMessage->sender_role=='doctor0'?new RoomMessageSenderResource($lastMessage->doctor):new RoomMessageSenderResource($lastMessage->patient)
        ];
        return ResponseHelper::success($data);
    }

    public function storeRoomMessage(Request $request)
    {

        $lastMessage = LiveChatMessage::orderBy('id','desc')->roomIn($request->room_id)->first();
        if ($lastMessage->sender_id == $request->user()->id && $lastMessage->sender_role == $request->user()->role) {
            $parent = LiveChatMessage::roomIn($request->room_id)
            ->where('sender_id', $request->user()->id)
            ->onlyParent()
            ->orderBy('id','desc')
            ->first();
            $message = LiveChatMessage::create([
                'room_id'=>$request->room_id,
                'sender_id'=>$request->user()->id,
                'message'=>$request->message,
                'sender_role'=>$request->user()->role,
                'parent_id'=>$parent->id
            ]);
            return ResponseHelper::success($message);
        }
        $message = LiveChatMessage::create([
            'room_id'=>$request->room_id,
            'sender_id'=>$request->user()->id,
            'sender_role'=>$request->user()->role,
            'message'=>$request->message,
        ]);
        return ResponseHelper::success(new RoomMessageResource($message));
    }

    public function storeChatImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $msg = LiveChatMessage::create([
                'room_id'=>$request->room_id,
                'sender_id'=>$request->user()->id,
                'sender_role'=>$request->user()->role,
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
            return ResponseHelper::success(new RoomMessageResource($msg));
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
