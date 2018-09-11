<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketTypeRequest;
use App\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * The event instance
     *
     * @var TicketType
     */
    protected $ticketType;

    /**
     * Create a new controller instance.
     *
     * @param TicketType $ticketType
     */
    public function __construct(TicketType $ticketType)
    {
        $this->ticketType = $ticketType;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTicketTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketTypeRequest $request)
    {
        $this->ticketType->create($request->all());
        return response()->json([], 201);
    }
}
