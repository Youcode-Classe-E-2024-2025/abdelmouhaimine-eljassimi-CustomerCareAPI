<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{

    public function authorize() : bool{
        return true;
    }
    public function rules() : array{
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high'
        ];
    }
}
