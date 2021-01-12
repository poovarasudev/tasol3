<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleRequest extends FormRequest
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
        if ($userId) {
            return [
                'role_id' => 'required|numeric|exists:roles,id',
            ];
        } else {
            return [
                'user_id' => 'required|numeric|exists:users,id,deleted_at,NULL',
                'role_id' => 'required|numeric|exists:roles,id',
            ];
        }
    }
}
