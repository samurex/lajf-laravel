<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'age' => [ 'required', 'integer', 'between:1,150'],
            'gender' => ['required', 'in:male,female,other'],
            'city' => ['string', 'max:255'],
            'occupation' => ['string', 'max:255'],
            'kids' => ['string', 'max:255'],
        ];
    }
}
