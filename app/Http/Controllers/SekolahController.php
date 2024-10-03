<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SekolahController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {

    //get all sekolah
    $sekolah = Sekolah::all();

    //render view with sekolah
    return view('admin.dataSekolah.dataSekolah', compact('sekolah'));
    }

    public function edit($id) {
        $sekolah = Sekolah::findOrFail($id);
        return view('admin.dataSekolah.dataSekolahedit', compact('sekolah'));
    }

    public function update(Request $request, $id) {
    $request->validate([
        'nama_sekolah' => 'required|string|max:255',
        'npsn' => 'required|string|max:255',
        'logo_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        // Tambahkan validasi untuk field lainnya
    ]);

    $sekolah = Sekolah::findOrFail($id);

    // Cek jika ada file gambar yang diupload
    if ($request->hasFile('logo_sekolah')) {
        // Hapus gambar lama jika ada
        if ($sekolah->logo_sekolah) {
            Storage::delete($sekolah->logo_sekolah);
        }

        // Simpan gambar baru dan dapatkan path-nya
        $logoPath = $request->file('logo_sekolah')->store('logos', 'public');
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $logoPath = $sekolah->logo_sekolah;
    }

    $sekolah->update([
        'nama_sekolah' => $request->nama_sekolah,
        'npsn' => $request->npsn,
        'jalan' => $request->jalan,
        'desa_kelurahan' => $request->desa_kelurahan,
        'kecamatan' => $request->kecamatan,
        'kabupaten' => $request->kabupaten,
        'provinsi' => $request->provinsi,
        'kode_pos' => $request->kode_pos,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'website' => $request->website,
        'kepala_sekolah' => $request->kepala_sekolah,
        'logo_sekolah' => $logoPath, // Simpan path gambar
    ]);

    return redirect()->route('sekolah.index')->with('success', 'Data sekolah berhasil diperbarui!');
}





}
