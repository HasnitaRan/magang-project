<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunAjaranRequest;
use App\Models\Tahun_ajaran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    public function index(): View
    {

        return view('admin.dataTahunAjaran.tahunajaran');
    }

    public function show(string $id): JsonResponse{
        return response()->json([
            'data' => Tahun_ajaran::find($id)
        ]);
    }

    public function store(TahunAjaranRequest $request): JsonResponse
    {
        $data = $request->validated();
        Tahun_ajaran::create($data);
        return response()->json(['message' => 'Data tahun ajaran berhasil ditambahkan']);
    }

    public function destroy(string $id){
        Tahun_ajaran::destroy($id);
        return response()->json(['message' => 'Data tahun ajaran berhasil dihapus']);
    }

    public function update(TahunAjaranRequest $request, string $id){
        $data = $request->validated();
        Tahun_ajaran::find($id)->update($data);
        return response()->json(['message' => 'Data tahun ajaran berhasil diperbarui']);
    }


    public function serversideTable(Request $request)
    {
        $user = Tahun_ajaran::get();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<div>
                <button class="btn btn-sm btn-success" onclick="editModal(this)" data-id="' . $row->id_tahunAjaran . '">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id_tahunAjaran . '">Hapus</button>
            </div>';
            })
            ->rawColumns(['aksi'])
            ->make();
    }
}