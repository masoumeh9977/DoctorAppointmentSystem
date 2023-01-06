<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'date' => 'bail|required|date',
            'time_from' => 'bail|required',
            'time_to' => 'bail|required|after:time_from',
            'capacity' => 'required|numeric|gt:0',
            'is_available' => ''
        ];
    }
}
