<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * The event instance
     *
     * @var Event
     */
    protected $event;

    /**
     * Create a new controller instance.
     *
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->event->newQuery()->with(['location', 'ticketTypes'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEventRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        $this->event->create($request->all());
        return response()->json([], 201);
    }
}
