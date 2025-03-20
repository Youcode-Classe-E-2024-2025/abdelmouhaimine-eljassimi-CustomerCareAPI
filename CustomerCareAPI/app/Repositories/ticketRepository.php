<?php

namespace App\Repositories;

use App\Models\ticket;

class ticketRepository{
    public function findById($id){ return ticket::where('id', $id)->first();}

    public function create(array $data)
    {
        return Ticket::create($data);
    }
    public function update(Ticket $ticket, array $data)
    {
        $ticket->update($data);
        return $ticket;
    }

}
