<?php

namespace App\Http\Controllers\Patient;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\LiveChatMessage;
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
        $messages = LiveChatMessage::roomIn($room->id)->onlyParent()->with('room','user','media')->get();
        $lastMessage = LiveChatMessage::orderBy('id','desc')->first();
        return view('Patient.page.Chat.live-chat',compact('room','messages','lastMessage'));
    }
}
