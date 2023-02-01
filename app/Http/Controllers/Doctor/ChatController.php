<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Room;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\LiveChatMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    //index
    public function index(Request $request)
    {
        $rooms = Room::active()->get();
        return view('Doctor.page.Chat.index', compact('rooms'));
    }

    public function show(Request $request)
    {
        $room = Room::where('slug', $request->room_id)->first();
        $messages = LiveChatMessage::roomIn($room->id)->onlyParent()->with('room', 'doctor', 'patient', 'media')->get();
        $lastMessage = LiveChatMessage::orderBy('id', 'desc')->first();
        return view('Doctor.page.Chat.live-room', compact('room', 'messages', 'lastMessage'));
    }

    public function store(Request $request)
    {
        $room = Room::where('slug', $request->room_id)->first();
        if ($request->parent == 'true') {
            $parent = LiveChatMessage::roomIn($room->id)
                ->where('user_id', $request->id)
                ->onlyParent()
                ->orderBy('id', 'desc')
                ->first();
            LiveChatMessage::create([
                'room_id' => $room->id,
                'sender_id' => doctorAuth()->id,
                'sender_role' => doctorAuth()->role,
                'message' => $request->message,
                'parent_id' => $parent->id
            ]);
        } else {
            LiveChatMessage::create([
                'room_id' => $room->id,
                'sender_role' => doctorAuth()->role,
                'sender_id' => doctorAuth()->id,
                'message' => $request->message,
            ]);
        }
    }

    public function storeImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $msg = LiveChatMessage::create([
                'room_id' => $request->room_id,
                'sender_id' => doctorAuth()->id,
                'sender_role' => doctorAuth()->role,
                'message' => ''
            ]);
            $path = LiveChatMessage::UPLOAD_PATH . '/' . date('Y') . "/" . date('m') . "/";
            $fileName = uniqid() . time() . '.' . $request->image->extension();
            $request->image->move(public_path($path), $fileName);
            Media::create([
                'image' => $path . $fileName,
                'mediable_id' => $msg->id,
                'mediable_type' => LiveChatMessage::class
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
    }
}
