<?php

namespace App\Http\Controllers;

use App\Models\M_chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_chat extends Controller
{
    public function getChat(Request $request)
    {
        $result = DB::select("SELECT * FROM m_chats INNER JOIN m__admins ON m_chats.idadmin = m__admins.id
        WHERE m_chats.idgroupchat = ? ORDER BY m_chats.created_at ASC", [$request->idgroupchat]);
        return response()->json(['data' => $result]);
    }
    public function addChat(Request $request)
    {
        $mChat = new M_chat;
        $mChat->idgroupchat = $request->idgroupchat;
        $mChat->content_chat = $request->contentChat;
        $mChat->idadmin = $request->idadmin;
        $mChat->is_seen = 0;
        $mChat->is_read = 0;
        $mChat->save();
        return response()->json(['data' => $mChat]);
    }
}
