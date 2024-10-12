<?php

namespace App\Http\Controllers;

use App\Models\Tahun_ajaran;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function activateTahunAjaran($id)
{
    // Nonaktifkan semua tahun ajaran yang sedang aktif
    Tahun_ajaran::where('is_active', 1)->update(['is_active' => 0]);

    // Aktifkan tahun ajaran yang dipilih
    $tahunAjaran = Tahun_ajaran::find($id);
    $tahunAjaran->is_active = 1;
    $tahunAjaran->save();

    // Arsipkan data berdasarkan tahun ajaran sebelumnya
    // $this->arsipkanDataTahunAjaranLama();

    // return redirect()->back()->with('success', 'Tahun ajaran baru berhasil diaktifkan dan data lama diarsipkan.');
}

public function arsipkanDataTahunAjaranLama()
{
    // Ambil tahun ajaran yang baru saja dinonaktifkan
    $tahunAjaranLama = Tahun_ajaran::where('is_active', 0)->orderBy('updated_at', 'desc')->first();

    if ($tahunAjaranLama) {
        // Arsipkan data di tabel Rombel
        // Rombel::where('id_tahun_ajaran', $tahunAjaranLama->id)
        //     ->update(['is_arsip' => 1]);

        // Arsipkan data di tabel lainnya (contoh: Nilai Pembelajaran)
        // NilaiPembelajaran::where('id_tahun_ajaran', $tahunAjaranLama->id)
        //     ->update(['is_arsip' => 1]);
        
        // Tambahkan proses arsip untuk tabel lain jika diperlukan
    }
}
}
