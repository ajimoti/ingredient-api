<?php

namespace App\Http\Requests;

use App\Ingredient;
use App\Http\Requests\Api\FormRequest;

class IngredientStoreRequest extends FormRequest
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
            'measure' => 'required|in:' . $this->measures(),
            'supplier' => 'required'
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
            'measure.in' => 'Measure has to be any of these: ' . $this->measures()
        ];
    }

    private function measures()
    {
        return implode(",", (new Ingredient())->measures());
    }
}
