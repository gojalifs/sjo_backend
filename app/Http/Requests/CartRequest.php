<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'carts' => 'required|array|min:1',
            'carts.*.lens_id' => 'nullable|integer',
            'carts.*.frame_id' => 'required|integer',
            'carts.*.qty' => 'required|integer|min:1',
            'carts.*.eye' => 'nullable|string|max:1|in:L,R',
            'carts.*.sphere' => 'nullable|numeric',
            'carts.*.cylinder' => 'nullable|numeric',
            'carts.*.axis' => 'nullable|integer',
            'carts.*.add' => 'nullable|numeric',
            'carts.*.prism' => 'nullable|numeric',
            'carts.*.base' => 'nullable|string|max:5',
        ];
    }
}
