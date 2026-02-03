<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'transaction_date' => ['repuired', 'date'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($q) use ($userId) {
                    $q->where('is_active', true)
                      ->where(function ($q) use ($userId) {
                        $q->whereNull('user_id')
                          ->orWhere('user_id', $userId);
                      });
                }),
            ],
            'amount' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'integer'],
            'vendor_id' => [
                'nullable',
                Rule::exists('vendors', 'id')->where(fn ($q) => $q->where('user_id', $userId)->where('is_active', true)),
            ],
            'note' => ['nullable', 'string'],

        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'カテゴリを選択してください',
            'amount.required' => '金額を入力してください',
            'amount.integer' => '金額は数字で入力してください',
            'amount.min' => '金額は１円以上で入力してください'
        ];
    }
}
