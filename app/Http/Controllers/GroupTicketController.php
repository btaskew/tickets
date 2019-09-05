<?php

namespace App\Http\Controllers;

use App\Group;

class GroupTicketController extends Controller
{
    /**
     * @param Group $group
     * @return \Illuminate\View\View
     */
    public function index(Group $group)
    {
        return view('groups.index', [
            'tickets' => $group->getGroupedTickets()
        ]);
    }
}
