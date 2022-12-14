<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PessoaRequest extends FormRequest
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
            'nome' => ['required'],
            'sobrenome' => ['required'],
            'idade' => ['required', 'integer'],
            'login' => ['required'],
            'senha' => ['required'],
            'status' => ['required', 'integer'],
            'enderecos' => ['required', 'array']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O atributo \'nome\' é obrigatório',
        ];
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'mensagem' => $validator->messages()->first(),
            'status' => 503
        ], 503));
    }
}
