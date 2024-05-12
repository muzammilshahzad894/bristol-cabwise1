<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FleetRequest extends FormRequest
{


    public function rules(): array
    {
        return [
        'title'=>'required',
        'description'=>'required',
        'feature_name'=>'max:225',
        'banner_image'=>'required',
        'max_passengers'=>'required',
        'max_suitcases'=>'required',
        'max_hand_luggage'=>'required',
        'rate'=>'required',
        'images'=>'required',
        'image_title'=>'max:225',
        'image_description'=>'max:500',
        'logo'=>'image',
        'name'=>'max:225',
        'tax_title'=>'max:225',
        'tax_amount'=>'max:225',
        ];
    }
}