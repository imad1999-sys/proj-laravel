<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>__('messages.offerNameRequired'),
            'name_ar.required'=>__('messages.offerNameRequired'),
            'price.required'=>__('messages.priceRequired'),
            'price.numeric'=>__('messages.priceNumeric')
        ];
    }
}
