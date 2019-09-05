<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Group extends Model
{
    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * @return Collection
     */
    public function getGroupedTickets(): Collection
    {
        return $this->tickets()
            ->with('assignee.user')
            ->get()
            ->groupBy(function ($ticket) {
                if (is_null($ticket->assignee)) {
                    return 'unassigned';
                }

                return $ticket->assignee->user->name;
            });
    }
}
