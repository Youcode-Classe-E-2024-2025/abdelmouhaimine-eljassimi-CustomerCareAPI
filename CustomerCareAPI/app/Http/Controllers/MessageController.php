<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessagesByTicket($ticketId)
    {
        return response()->json(Message::where('ticket_id', $ticketId)->orderBy('created_at', 'asc')->get(), 200);
    }
}
