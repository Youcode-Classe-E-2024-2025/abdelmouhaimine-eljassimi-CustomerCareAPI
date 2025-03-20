<?php
namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function getAllTickets()
    {
        return Ticket::all();
    }
    public function createTicket($data)
    {
        return Ticket::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority']
        ]);
    }
}
