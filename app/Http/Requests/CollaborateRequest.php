<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CollaborateRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','string', 'max:255'],
            'birthday' => ['required', 'date'],
            'imagen' => ['required', 'image'],
        ];

        // Verificar si la solicitud es de tipo PUT o PATCH (actualización)
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Excluir la validación de imagen en actualizaciones
            unset($rules['imagen']);
        }

        return $rules;

    }
}
