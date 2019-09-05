<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        Ticket::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id()
        ]);
    }
}
