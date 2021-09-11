<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            
            'new_prod' => ['required', 'unique:tbl_articulostock,idlarticulos'],
            'new_nom' => 'required',
            'selcate' => 'required',
            
        ];
    }


    public function messages()
    {
        return [

            'new_prod.required' => 'Necesitas un Codigo de Producto',
            'new_nom.required' => 'Necesitas una descripcion del Producto',
            'selcate.required' => 'Necesitas una categoria para el Producto'

        ];

    }

}
