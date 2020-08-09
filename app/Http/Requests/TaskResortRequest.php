<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskResortRequest extends FormRequest
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
            'tasks' => [
                'array',
                'required',
            ],
            'tasks.*.id' => ['integer', 'required'],
            'tasks.*.name' => ['string', 'required', 'max:255'],
        ];
    }
}
