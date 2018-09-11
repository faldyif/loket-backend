<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer.name' => 'required|between:5,100',
            'customer.email' => 'required|between:5,100',
            'customer.phone' => 'required|between:5,100',
            'customer.address' => 'required|between:5,150',
            'event_id' => 'exists:events,id',
            'ticket_types.*.ticket_type_id' => 'exists:ticket_types,id',
            'ticket_types.*.quantity' => 'required|min:1'
        ];
    }
}
