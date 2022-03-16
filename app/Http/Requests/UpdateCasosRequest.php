<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCasosRequest extends FormRequest
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
            'dia' => 'required|unique:casos_confirmados,dia,' . $this->route('id')
    
        ];
    }

    
    public function messages()
    {
        return [
            'required' => 'Campo é necessario',
            'unique' => 'O dia já consta em nossa base de dados'
            
        ];
    }
}
