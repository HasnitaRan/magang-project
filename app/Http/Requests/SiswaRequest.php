<?php

namespace App\Http\Requests;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
        $siswa = Siswa::find($this->route('siswa'));
        $userId = $siswa ? $siswa->user_id : null; // Temukan siswa berdasarkan ID dari route

        return [
            'nama_siswa' => 'required|string|max:50',
            'nis' => 'required|numeric|digits:5', // Validasi untuk NIS
            'nisn' => 'required|numeric|digits:10', // Validasi untuk NISN
            'tempat_lahir' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|exists:agama,id', // Pastikan id agama valid
            'alamat' => 'required|string|max:200',
            'no_hp' => 'required|numeric|digits_between:10,13', // Validasi untuk no_hp
            'email' => 'required|email|max:50|unique:users,email,'. $userId,
            'status_aktif' => 'required|in:aktif,nonaktif,',
            'status_dalam_keluarga'=>'required|in:anak kandung,anak angkat,anak tiri,',
            'anak_ke' => 'required|numeric|digits:2',
            'tahun_masuk'=> 'required|numeric|digits:4',
        ];
    }
}