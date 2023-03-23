<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrameRequest extends FormRequest
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
    public function rules($id)
    {
        if ($id) {
            return [
                "name" => "nullable",
                "stock" => "nullable",
                "price" => "nullable",
                "material" => "nullable",
                "shape" => "nullable",
                "description" => "nullable",
                "rating" => "nullable"
            ];
        } else {
            return [
                "name" => "required",
                "stock" => "required",
                "price" => "required",
                "material" => "required",
                "shape" => "required",
                "description" => "required",
                "rating" => "nullable"
            ];
        }

    }
}