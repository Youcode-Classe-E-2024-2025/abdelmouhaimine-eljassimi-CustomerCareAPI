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
        return $this->ticketRepository->create([
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


    public function updateTicket($ticket, $data)
    {
        return $this->ticketRepository->update($ticket, $data);
    }

    public function deleteTicket($ticket)
    {
        return $this->ticketRepository->delete($ticket);
    }
}
