<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * The event instance
     *
     * @var Transaction
     */
    protected $transaction;

    /**
     * Create a new controller instance.
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->transaction->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $this->transaction->storeTransactionWithCustomerData($request->all());
        return response()->json([], 201);
    }
}
