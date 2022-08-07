<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class
EditVeiculoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return  [
            'id' => 'required|exists:veiculo,id',
            'placa' => 'required',
            'marca_id' => 'required|exists:marca,id',
            'modelo' => 'required',
            'cor' => 'required',
            'ano' => 'required',
            'valor' => 'required',
            'disponivel' => 'required'
        ];
    }
}
