<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAluguelRequest extends FormRequest
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
        return [
            'id' => 'required|exists:aluguel,id',
            'cliente_id' => 'required|exists:cliente,id',
            'funcionario_id' => 'required|exists:users,id',
            'veiculo_id' => 'required|exists:veiculo,id',
            'data_emprestimo' => 'required|date',
            'prazo' => 'required|date',
            'data_entrega' => 'sometimes',
            'entregue' => 'required',
        ];
    }
}
