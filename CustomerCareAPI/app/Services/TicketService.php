<?php
namespace App\Services;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ticketRepository;

class TicketService
{
    protected $ticketRepository;

    public function __construct(ticketRepository $ticketRepository){
        $this->ticketRepository = $ticketRepository;
    }
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

    public function getTicketById($id)
    {
        return $this->ticketRepository->findById($id);
    }
}
