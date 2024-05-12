<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'request_type'=>'required',
            'payment_type'=>'required',
            'pickup_address'=>'required',
            'destination_address'=>'required',
            'pickup_date_time'=>'required',
            'fleet_id'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'no_of_passengers'=>'required',
            'child_seat'=>'required',
            'suitcases'=>'required',
            'hand_luggage'=>'required',
            'payment_amount'=>'required',
        ];
    }
}
