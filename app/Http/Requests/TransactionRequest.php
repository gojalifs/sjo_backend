<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'shipping_id' => 'required|integer',
            'delivery_fee' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'transactions' => 'required|array|min:1',
            'transactions.*.lens_id' => 'nullable|integer',
            'transactions.*.frame_id' => 'required|integer',
            'transactions.*.qty' => 'required|integer|min:1',
            'transactions.*.reye' => 'nullable|string|max:1|in:L,R',
            'transactions.*.rsphere' => 'nullable|numeric',
            'transactions.*.rcylinder' => 'nullable|numeric',
            'transactions.*.raxis' => 'nullable|integer',
            'transactions.*.radd' => 'nullable|numeric',
            'transactions.*.rprism' => 'nullable|numeric',
            'transactions.*.rbase' => 'nullable|string|max:5',
            'transactions.*.leye' => 'nullable|string|max:1|in:L,R',
            'transactions.*.lsphere' => 'nullable|numeric',
            'transactions.*.lcylinder' => 'nullable|numeric',
            'transactions.*.laxis' => 'nullable|integer',
            'transactions.*.ladd' => 'nullable|numeric',
            'transactions.*.lprism' => 'nullable|numeric',
            'transactions.*.lbase' => 'nullable|string|max:5',
        ];
    }
}