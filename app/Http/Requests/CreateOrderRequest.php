<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|digits:11',
            'cep' => 'required|digits:8',
            'shipping' => 'required|numeric|gt:0',
            'value' => 'required|numeric|gt:0',
            'items' => 'required|array',
            'items.*.sku' => 'required|string|size:8',
            'items.*.desc' => 'required|string',
            'items.*.value' => 'required|numeric|gt:0',
            'items.*.qtd' => 'required|integer|gt:0',
        ];
    }
}
