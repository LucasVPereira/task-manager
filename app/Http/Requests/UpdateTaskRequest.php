<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    // Verifica se o usuário tem permissão para fazer essa requisição
    public function authorize()
    {
        return true; // Altere se precisar de algum controle de autorização
    }

    // Define as regras de validação
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'status' => 'required|in:pending,in_progress,completed',  // Status com valores possíveis
            'description' => 'nullable|string',  // A descrição é opcional
        ];
    }
}