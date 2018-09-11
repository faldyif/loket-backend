<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    /**
     * Get the location of the event object.
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Get the ticket types for the event object.
     */
    public function ticketTypes()
    {
        return $this->hasMany('App\TicketType');
    }
}
