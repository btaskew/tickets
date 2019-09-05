<?php

namespace App\Http\Controllers;

class AssignedTicketController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('tickets.index', [
            'tickets' => auth()->user()->staffUser->assignedTickets
        ]);
    }
}
