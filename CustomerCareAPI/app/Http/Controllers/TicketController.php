<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index()
    {
        return response()->json($this->ticketService->getAllTickets());
    }


    public function store(CreateTicketRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->ticketService->createTicket($data), 201);
    }

    public function show($id){
        return response()->json([$this->ticketService->getTicketById($id)], 200);
    }


    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'status' => 'in:open,in_progress,resolved,closed',
            'agent_id' => 'nullable|exists:users,id'
        ]);
        return response()->json($this->ticketService->updateTicket($ticket, $data));
    }
}
