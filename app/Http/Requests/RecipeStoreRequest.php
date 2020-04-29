<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class RecipeStoreRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'description' => 'required',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'required|numeric|exists:ingredients',
            'ingredients.*.amount' => 'required|numeric'
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
            'ingredients.*.id' => 'Invalid Ingredient id, ensure the id supplied exists in the ingredient response',
            'ingredients.*.amount' => 'Invalid amount, amount has to be numeric',
        ];

    }
}
