<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
        $menuId = $this->route('menuId');
        return [
            'name' => 'required|unique:menus,name,' . $menuId . ',id,deleted_at,NULL|min:2|max:50',
            'price' => 'required|min:1|max:500',
            'for' => 'required|in:'. MENU_FOR_BREAKFAST . ',' . MENU_FOR_LUNCH,
            'order_type' => 'required|in:'. ORDER_TYPE_SINGLE . ',' . ORDER_TYPE_MULTIPLE,
            'bill_type' => 'required|in:'. BILL_TYPE_PER_UNIT . ',' . BILL_TYPE_EQUALLY_DIVIDED,
        ];
    }
}
