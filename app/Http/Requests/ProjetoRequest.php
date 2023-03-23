<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome_projeto' => 'required | max:255',
            'descricao' => 'required | max:255',
            'data_inicio' => 'required',
            'data_fim' => 'required',
            'edital' => 'required',
            'categorias' => 'array | min:1',
        ];
    }
}
