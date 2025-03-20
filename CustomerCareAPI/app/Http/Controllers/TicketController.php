<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
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
}
