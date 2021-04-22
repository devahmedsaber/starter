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
            'name_ar' => 'required|max:100',
            'name_en' => 'required|max:100',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('messages.OfferNameRequired'),
            'name_en.required' => trans('messages.OfferNameRequired'),
            'name_ar.unique' => trans('messages.OfferNameUnique'),
            'name_en.unique' => trans('messages.OfferNameUnique'),
            'price.required' => trans('messages.PriceRequired'),
            'price.numeric' => trans('messages.PriceNumeric'),
            'details_ar.required' => trans('messages.DetailsRequired'),
            'details_en.required' => trans('messages.DetailsRequired'),
        ];
    }
}
