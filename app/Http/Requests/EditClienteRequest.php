<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditClienteRequest extends FormRequest
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
            'id' => 'required|exists:cliente,id',
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required|numeric',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|max:2',
            'telefone' => 'required',
            'data_nascimento' => 'required|date',
        ];
    }
}
