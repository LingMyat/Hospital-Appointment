<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //create
    public function create(Request $request)
    {
        return view('Admin.share.modal.room');
    }
}
