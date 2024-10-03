<?php

namespace App\Http\Requests;

use App\Models\Guru;
use Illuminate\Foundation\Http\FormRequest;

class GuruRequest extends FormRequest
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
        $guru = Guru::find($this->route('guru'));
        $userId = $guru ? $guru->user_id : null; // Temukan guru berdasarkan ID dari route

        return [
            'nama_guru' => 'required|string|max:50',
            'nip' => 'required|numeric|digits:18', // Validasi untuk NIP
            'tempat_lahir' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|exists:agama,id', // Pastikan id agama valid
            'alamat' => 'required|string|max:200',
            'no_hp' => 'required|numeric|digits_between:10,13', // Validasi untuk no_hp
            'email' => 'required|email|max:50|unique:users,email,'. $userId,
            'status_aktif' => 'required|in:aktif,nonaktif,',

        ];
    }
}