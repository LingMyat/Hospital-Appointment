<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\LiveChatMessage;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    //index
    public function index(Request $request)
    {
        $rooms = Room::active()->get();
        return view('Doctor.page.Chat.index',compact('rooms'));
    }

    public function show(Request $request)
    {
        $room = Room::where('slug',$request->room_id)->first();
        $messages = LiveChatMessage::roomIn($room->id)->onlyParent()->with('room','user','media')->get();
        $lastMessage = LiveChatMessage::orderBy('id','desc')->first();
        return view('Doctor.page.Chat.live-room',compact('room','messages','lastMessage'));
    }
}
