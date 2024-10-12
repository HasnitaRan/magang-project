<?php

namespace App\Http\Controllers\Admin;

use App\Models\Elemen;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ElemenRequest;
use App\Models\Dimensi;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class ElemenController extends Controller
{
    public function index(string $dimensi_id): View
    {
        // Ambil dimensi berdasarkan ID
        $dimensi = Dimensi::findOrFail($dimensi_id);

        // Ambil elemen-elemen yang terkait dengan dimensi ini
        $elemen = Elemen::where('id_dimensi', $dimensi->id)->get();

        // Kirimkan data dimensi dan elemen ke view
        return view('admin.dataElemen.dataElemen', compact('dimensi', 'elemen'));
    }

    public function create()
    {
        return view('elemen.create');
    }

    // public function show(string $id)
    // {
    //     $elemen = Elemen::find($id);

    //     // Cek apakah elemen ditemukan
    //     if (!$elemen) {
    //         return redirect()->route('elemen.index')->with('error', 'Elemen tidak ditemukan.');
    //     }

    //     // Cek apakah permintaan adalah AJAX (untuk JSON)
    //     if (request()->ajax()) {
    //         return response()->json([
    //             'data' => $elemen
    //         ]);
    //     }

    //     // Jika bukan AJAX, kembalikan tampilan detail
    //     return view('elemen.show', compact('elemen'));
    // }


    public function store(ElemenRequest $request, $dimensi_id): JsonResponse
{
    $data = $request->validated();
    $data['id_dimensi'] = $dimensi_id;
    Elemen::create($data);

    return response()->json(['message' => 'Data Elemen berhasil ditambahkan']);
}


    public function destroy(string $id){
        Elemen::destroy($id);
        return response()->json(['message' => 'Data Elemen berhasil dihapus']);
    }

    public function update(ElemenRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();

        $elemen = Elemen::find($id);
        $elemen->update($data);

        

        return response()->json(['message' => 'Data Elemen berhasil diperbarui']);
    }


    public function serversideTable(Request $request, $dimensi_id)
    {
        $elemen = Elemen::where('id_dimensi', $dimensi_id)->get();
        return DataTables::of($elemen)
            ->addIndexColumn()
            ->addColumn('dimensi', function ($row) {
                return $row->dimensi ? $row->dimensi->dimensi . ' - ' . $row->dimensi->dimensi : 'Tidak ada';
            })
            ->addColumn('aksi', function ($row) {
                return '<div>
                <button class="btn btn-sm btn-success" onclick="editModal(this)" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id . '">Hapus</button>
            </div>';
            })
            ->rawColumns(['aksi'])
            ->make();
    }
    
}