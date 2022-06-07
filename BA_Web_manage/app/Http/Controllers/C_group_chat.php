<?php

namespace App\Http\Controllers;

use App\Models\M_group_chat;
use Illuminate\Http\Request;

class C_group_chat extends Controller
{
    public function addGroupChat(Request $request)
    {
        $mGroupChat = new M_group_chat;
        $mGroupChat->fullname = $request->fullname;
        $mGroupChat->phone = $request->phone;
        $mGroupChat->save();
        return response()->json(['data' => $mGroupChat]);
    }
}
