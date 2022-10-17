<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TwoFactorAuthRequest extends FormRequest
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
            'type' => 'required|in:sms,email',
            'phone' => 'required_if:type,==,sms|nullable|unique:users,phone,'.$this->user()->id. ',id',
            'email' => 'required_if:type,==,email|nullable|unique:users,email,'.$this->user()->id. ',id',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'type.required' => 'Fill type.',
            'phone.required_if' => 'Fill phone.',
            'email.required_if' => 'Fill email.',
        ];
    }
}
