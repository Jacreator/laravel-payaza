<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitTransactionRequest extends FormRequest
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
        return [
            "receiver_email"=> "required|email",
            "amount"=> "required",
            "fee"=> "required",
            "total_amount"=> "required",
            "description"=> "required",
            "email"=> "required|email",
            "user"=> "required",
            "transType"=> "required",
        ];
    }
}
