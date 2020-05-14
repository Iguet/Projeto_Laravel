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
            'titulo' => [
                'required',
                Rule::unique('demandas')->where(function ($query) {
                    return $query->where('titulo', 'titulo');
                }),
                'max:50'
            ],
            'descricao' => ['required', 'max:50'],
            'projeto_id' => ['required'],
            'user_id' => ['required'],

        ];
    }

    public function messages()
    {

        return [
            'titulo.required' => 'O campo é obrigatório',
            'titulo.unique' => 'O campo deve ser único',
            'titulo.max' => 'O campo deve ter no máximo 50 caracteres',
            'descricao.required' => 'O campo é obrigatório',
            'descricao.max' => 'O campo deve ter no máximo 50 caracteres',
            'projeto_id.required' => 'O campo é obrigatório',
            'user_id.required' => 'O campo é obrigatório',
        ];

    }
}
