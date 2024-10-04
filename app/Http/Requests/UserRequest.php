<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|min:5|max:18',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
            // 'password' => [
            //     'required',
            //     'string',
            //     'min:8', // Minimal 8 karakter
            //     'regex:/[a-z]/', // Harus ada huruf kecil
            //     'regex:/[A-Z]/', // Harus ada huruf kapital
            //     'regex:/[0-9]/' // Harus ada angka
            // ],
        ];
    }
}