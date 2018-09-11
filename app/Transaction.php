<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function ticketTypes()
    {
        return $this->hasMany('App\TransactionDetail');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function storeTransactionWithCustomerData($data) {

        $customer = Customer::create($data['customer']);
        $data['customer_id'] = $customer->id;

        $ticketTypes = $data['ticket_types'];

        unset($data['customer']);
        unset($data['ticket_types']);

        // Create new transaction
        $transaction = $this->create($data);

        $totalPrice = $this->storeTransactionDetails($ticketTypes, $transaction->id);
        $transaction->total_price = $totalPrice;
        $transaction->save();

        return true;
    }

    public function storeTransactionDetails($data, $transaction_id) {

        $totalPrice = 0;

        foreach ($data as $key) {
            $key['transaction_id'] = $transaction_id;
            $transactionDetail = TransactionDetail::create($key);
            $totalPrice += $transactionDetail->price;
        }

        return $totalPrice;

    }
}
