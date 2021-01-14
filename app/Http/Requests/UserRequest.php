<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('userId') ?? null;
        return [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users,email,' . $userId . ',id,deleted_at,NULL',
            'phone' => 'required|digits:10|unique:users,phone,' . $userId . ',id',
            'password' => ($userId && $this->request->get('password')) ? 'required|min:6|max:15' : '',
            'team_id' => 'required|numeric|exists:teams,id,deleted_at,NULL',
            'gender' => 'required|in:'. GENDER_MALE . ',' . GENDER_FEMALE . ',' . GENDER_OTHER,
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'team_id' => 'team',
            'phone' => 'mobile number',
        ];
    }
}
