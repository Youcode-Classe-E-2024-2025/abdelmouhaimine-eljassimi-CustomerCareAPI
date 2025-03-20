<?php

namespace App\Repositories;

use App\Models\ticket;

class ticketRepository{
    public function findById($id){ return ticket::where('id', $id)->first();}

    public function create(array $data)
    {
        return Ticket::create($data);
    }
}
