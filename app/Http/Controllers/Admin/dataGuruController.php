<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\GuruRequest;
use Illuminate\Http\JsonResponse;


class dataGuruController extends Controller
{
    public function index(): View
    {
        return view('admin.dataGuru.dataGuru');
    }


    public function show($id) {
        $guru = Guru::with(['user', 'agama'])->find($id); // Load relasi user dan agama
        return response()->json([
            'data' => $guru,
            'email' => $guru->user ? $guru->user->email : null,
            'status_aktif' => $guru->user ? $guru->user->status_aktif : null
        ]);
    }


    public function serversideTable(Request $request)
    {
        $guru = Guru::with('user',)->get(); // Untuk meload relasi agama
        return DataTables::of($guru)
            ->addIndexColumn()
            ->addColumn('status_aktif', function ($row) {
                return $row->user ? $row->user->status_aktif : 'Tidak ada status';
            })
            ->addColumn('email', function ($row) {
                return $row->user ? $row->user->email : 'Tidak ada email';
            })
            ->addColumn('aksi', function ($row) {
                return '<div>
                <button class="btn btn-sm btn-secondary" data-id="' . $row->id_guru . '">Show</button>
                <button class="btn btn-sm btn-warning" onclick="editModal(this)" data-id="' . $row->id_guru . '">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id_guru . '">Hapus</button>
            </div>';
            })
            ->rawColumns(['aksi'])
            ->make();
    }

    public function store(GuruRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Buat user baru berdasarkan NIP
        $user = User::create([
            'username' => $data['nip'], // Username berdasarkan NIP
            'email' => $data['email'],
            'password' => Hash::make('Guru12345'),
            'role' => 'guru', // Set role menjadi guru
        ]);

        // Buat data guru dengan user_id dari user yang baru dibuat
        $guru = Guru::create([
            'nama_guru' => $data['nama_guru'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nip' => $data['nip'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tgl_lahir' => $data['tgl_lahir'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'user_id' => $user->id,
            'agama_id' => $data['agama'],
        ]);

        return response()->json(['success' => 'Data guru berhasil disimpan']);
    }

    public function destroy(string $id){
        Guru::destroy($id);
        return response()->json(['message' => 'Data guru berhasil dihapus']);
    }

    public function update(GuruRequest $request, $id): JsonResponse
{
    $data = $request->validated();
    $guru = Guru::find($id);

    // Update data guru
    $guru->update([
        'nama_guru' => $data['nama_guru'],
        'jenis_kelamin' => $data['jenis_kelamin'],
        'nip' => $data['nip'],
        'tempat_lahir' => $data['tempat_lahir'],
        'tgl_lahir' => $data['tgl_lahir'],
        'no_hp' => $data['no_hp'],
        'alamat' => $data['alamat'],
        'agama_id' => $data['agama'],
    ]);

    // Update user jika email diubah
    if ($guru->user) {
        $guru->user->update([
            'email' => $data['email'],
            'status_aktif'=>$data['status_aktif']
        ]);
    }

    return response()->json(['success' => 'Data guru berhasil diperbarui']);
}

}
