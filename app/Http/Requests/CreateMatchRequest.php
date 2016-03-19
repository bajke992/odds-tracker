<?php

namespace App\Http\Requests;

class CreateMatchRequest extends Request
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
            'odds'      => 'string|required',
            'x'         => 'numeric|required',
            'y'         => 'numeric|required',
            'type'      => 'string|required',
            'status'    => 'string|required',
            'league_id' => 'integer|required'
        ];
    }
}
