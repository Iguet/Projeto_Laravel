<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DemandasRequest extends FormRequest
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
            'Titulo' => [
                'required',
                Rule::unique('demandas')->where(function ($query) {
                    return $query->where('titulo', 'Titulo');
                }),
                'max:50'
            ],
            'Descricao' => ['required'],
            'Projeto' => ['required'],
            'User' => ['required'],
            'Estado' => ['required']
        ];
    }

    public function messages()
    {

        return [
            'Titulo.required' => 'O campo é obrigatório',
            'Titulo.unique' => 'O campo deve ser único',
            'Titulo.max' => 'O campo deve ter no máximo 50 caracteres',
            'Descricao.required' => 'O campo é obrigatório',
            'Projeto.required' => 'O campo é obrigatório',
            'User.required' => 'O campo é obrigatório',
            'Estado.required' => 'O campo é obrigatório'
        ];

    }
}
