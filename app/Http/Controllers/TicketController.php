<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $ticket = Ticket::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'group_id' => $request->input('group'),
            'user_id' => auth()->id()
        ]);

        return redirect('tickets/' . $ticket->id);
    }

    /**
     * @param Ticket $ticket
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return view('tickets.show', compact('ticket'));
    }
}
