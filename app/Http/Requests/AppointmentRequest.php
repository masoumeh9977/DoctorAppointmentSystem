<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'time_from' => 'bail|required_if:is_completed,==,false',
            'time_to' => 'bail|required_if:is_completed,==,false|after:time_from',
            'patient_symptom' => 'bail|required_if:is_completed,==,false|string',
            'patient_comment' => 'bail|required_if:is_completed,==,false|string',
            'symptom_image' => 'image|nullable',
            'is_completed' => 'bail|nullable|boolean'
        ];
    }
}
