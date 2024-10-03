<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SiswaRequest;
use Illuminate\Http\JsonResponse;

class dataSiswaController extends Controller
{
    public function index(): View
    {
        return view('admin.dataSiswa.dataSiswa');
    }


    public function show($id) {
        $siswa = Siswa::with(['user', 'agama'])->find($id); // Load relasi user dan agama
        return response()->json([
            'data' => $siswa,
            'email' => $siswa->user ? $siswa->user->email : null,
            'status_aktif' => $siswa->user ? $siswa->user->status_aktif : null
        ]);
    }


    public function serversideTable(Request $request)
    {
        $siswa = Siswa::with('user',)->get(); // Untuk meload relasi agama
        return DataTables::of($siswa)
            ->addIndexColumn()
            ->addColumn('status_aktif', function ($row) {
                return $row->user ? $row->user->status_aktif : 'Tidak ada status';
            })
            ->addColumn('email', function ($row) {
                return $row->user ? $row->user->email : 'Tidak ada email';
            })
            ->addColumn('aksi', function ($row) {
                return '<div>
                <button class="btn btn-sm btn-secondary" data-id="' . $row->id_siswa . '">Show</button>
                <button class="btn btn-sm btn-warning" onclick="editModal(this)" data-id="' . $row->id_siswa . '">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id_siswa . '">Hapus</button>
            </div>';
            })
            ->rawColumns(['aksi'])
            ->make();
    }

    public function store(SiswaRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Buat user baru berdasarkan NISN
        $user = User::create([
            'username' => $data['nisn'], // Username berdasarkan NISN
            'email' => $data['email'],
            'password' => Hash::make('Siswa12345'),
            'role' => 'siswa', // Set role menjadi siswa
        ]);

        // Buat data siswa dengan user_id dari user yang baru dibuat
        $siswa = Siswa::create([
            'nama_siswa' => $data['nama_siswa'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tgl_lahir' => $data['tgl_lahir'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'user_id' => $user->id,
            'agama' => $data['agama'],
            'status_dalam_keluarga' => $data['status_dalam_keluarga'],
            'anak_ke' => $data['anak_ke'],
            'tahun_masuk' => $data['tahun_masuk'],
            'asal_sekolah' => $data['asal_sekolah'],
        ]);

        return response()->json(['success' => 'Data siswa berhasil disimpan']);
    }

    public function destroy(string $id){
        Siswa::destroy($id);
        return response()->json(['message' => 'Data siswa berhasil dihapus']);
    }

    public function update(SiswaRequest $request, $id): JsonResponse
{
    $data = $request->validated();
    $siswa = Siswa::find($id);

    // Update data siswa
    $siswa->update([
        'nama_siswa' => $data['nama_siswa'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tgl_lahir' => $data['tgl_lahir'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'agama' => $data['agama'],
            'status_dalam_keluarga' => $data['status_dalam_keluarga'],
            'anak_ke' => $data['anak_ke'],
            'tahun_masuk' => $data['tahun_masuk'],
            'asal_sekolah' => $data['asal_sekolah'],

    ]);

    // Update user jika email diubah
    if ($siswa->user) {
        $siswa->user->update([
            'email' => $data['email'],
            'status_aktif'=>$data['status_aktif']
        ]);
    }

    return response()->json(['success' => 'Data siswa berhasil diperbarui']);
}

}
