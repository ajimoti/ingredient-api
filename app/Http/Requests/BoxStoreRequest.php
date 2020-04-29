<?php

namespace App\Http\Requests;

use App\Box;
use App\Rules\BoxRecipe;
use App\Rules\DeliveryDate;
use App\Http\Requests\Api\FormRequest;

class BoxStoreRequest extends FormRequest
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
            'user_id'   => 'required|numeric|exists:users,id',
            'delivery_date' => ['required', new DeliveryDate],
            'recipe_ids'    => ['required', 'array', new BoxRecipe],
            'recipe_ids.*'  => 'required|numeric|exists:recipes,id',
        ];
    }


     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id' => 'User id field is required, and must be the id of an existing user',
        ];

    }
}
