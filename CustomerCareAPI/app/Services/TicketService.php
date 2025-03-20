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
}
