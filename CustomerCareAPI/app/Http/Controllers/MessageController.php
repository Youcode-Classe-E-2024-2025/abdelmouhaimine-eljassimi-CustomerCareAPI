<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessagesByTicket($ticketId)
    {
        return response()->json(Message::where('ticket_id', $ticketId)->orderBy('created_at', 'asc')->get(), 200);
    }

    public function createMessage(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'sender_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'is_agent' => 'boolean',
        ]);

        $message = Message::create($validated);

        return response()->json($message, 201);
    }
}
