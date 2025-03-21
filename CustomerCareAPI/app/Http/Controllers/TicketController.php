<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Ticket",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Ticket ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Status of the ticket",
 *         enum={"open", "in_progress", "resolved", "closed"},
 *         example="open"
 *     ),
 *     @OA\Property(
 *         property="agent_id",
 *         type="integer",
 *         description="ID of the assigned agent",
 *         example=5
 *     ),
 * )
 */

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @OA\Get(
     *     path="/tickets",
     *     summary="Get all tickets",
     *     description="Returns a list of all tickets",
     *     @OA\Response(
     *         response=200,
     *         description="A list of tickets",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ticket")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->ticketService->getAllTickets());
    }


    /**
     * @OA\Post(
     *     path="/api/tickets",
     *     summary="Create a new ticket",
     *     tags={"Tickets"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Ticket Title"),
     *             @OA\Property(property="description", type="string", example="Ticket Description"),
     *             @OA\Property(property="agent_id", type="integer", example=1),
     *             @OA\Property(property="priority", type="string", example="low")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ticket created successfully",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Ticket"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    public function store(CreateTicketRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->ticketService->createTicket($data), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tickets/{id}",
     *     summary="Get a specific ticket",
     *     tags={"Tickets"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket details",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Ticket"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     )
     * )
     */
    public function show($id)
    {
        return response()->json([$this->ticketService->getTicketById($id)], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/tickets/{id}",
     *     summary="Update a ticket",
     *     tags={"Tickets"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"open", "in_progress", "resolved", "closed"}, example="open"),
     *             @OA\Property(property="agent_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket updated successfully",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Ticket"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     )
     * )
     */
    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'status' => 'in:open,in_progress,resolved,closed',
            'agent_id' => 'nullable|exists:users,id'
        ]);
        return response()->json($this->ticketService->updateTicket($ticket, $data));
    }

    /**
     * @OA\Delete(
     *     path="/api/tickets/{id}",
     *     summary="Delete a ticket",
     *     tags={"Tickets"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Ticket deleted")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket not found"
     *     )
     * )
     */
    public function destroy(Ticket $ticket)
    {
        $this->ticketService->deleteTicket($ticket);
        return response()->json(['message' => 'Ticket deleted']);
    }
}
