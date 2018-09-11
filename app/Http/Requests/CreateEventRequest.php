<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'name' => 'required|between:5,100',
            'description' => 'required|min:10',
            'location_id' => 'exists:locations,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date'
        ];
    }
}
