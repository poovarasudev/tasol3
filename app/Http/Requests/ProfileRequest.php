<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|min:2|max:30',
            'phone' => 'required|digits:10|unique:users,phone,' . auth()->id() . ',id',
            'gender' => 'required|in:'. GENDER_MALE . ',' . GENDER_FEMALE . ',' . GENDER_OTHER,
        ];
        if ($this->request->get('old_password') != '') {
            $rules = array_merge($rules, [
                'old_password' => 'required',
                'new_password' => 'required|min:6|max:15',
                'confirm_password' => 'required|required_with:new_password||min:6|max:15|same:new_password',
            ]);
        }
        return $rules;
    }
}
