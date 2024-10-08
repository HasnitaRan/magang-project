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
    public function index(): View
    {
        $dimensi= Dimensi::all();

        return view('admin.dataElemen.dataElemen', compact('dimensi'));
    }

    public function create()
    {
        return view('elemen.create');
    }

    public function show(string $id)
    {
        $elemen = Elemen::find($id);
        return response()->json([
            'data' => $elemen
        ]);
    }

    public function store(ElemenRequest $request): JsonResponse
    {
        $data = $request->validated();

        Elemen::create($data); // Create the Elemen
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


    public function serversideTable(Request $request)
    {
        $elemen = Elemen::get();
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