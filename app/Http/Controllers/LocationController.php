<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * The event instance
     *
     * @var Location
     */
    protected $location;

    /**
     * Create a new controller instance.
     *
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateLocationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLocationRequest $request)
    {
        $this->location->create($request->all());
        return response()->json([], 201);
    }
}
