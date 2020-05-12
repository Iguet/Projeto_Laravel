<?php

namespace App\Http\Requests;

use App\Projetos;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjetosRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('projetos')->where(function ($query) {
                    return $query->where('name', 'name');
                }),
                'max:50'
             ],
            'descricao' => 'required|max:50',
        ];
    }

    public function messages()
    {

        return [
            'nome.required' => 'O campo é obrigatório',
            'nome.unique' => 'O campo deve ser único',
            'nome.max' => 'O campo deve ter no máximo 50 caracteres',
            'descricao.required' => 'O campo é obrigatório',
            'descricao.max' => 'O campo deve ter no máximo 50 caracteres'
        ];

    }
}
