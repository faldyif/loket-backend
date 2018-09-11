<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [];

    public function ticketType()
    {
        return $this->belongsTo('App\TicketType');
    }

    public function getPriceAttribute()
    {
        return $this->quantity * $this->ticketType->price;
    }
}
