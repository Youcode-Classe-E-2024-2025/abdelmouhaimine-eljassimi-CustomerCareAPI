<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ["user_id","agent_id","title","description","status","priority"];
}
