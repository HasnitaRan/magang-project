<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dimensi;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DimensiRequest;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class DimensiController extends Controller
{
    public function index(): View
    {

        return view('admin.dataDimensi.dataDimensi');
    }


    public function create()
    {
        return view('dimensi.create');
    }

    public function show(string $id): JsonResponse{
        return response()->json([
            'data' => Dimensi::find($id)
        ]);
    }

    public function store(DimensiRequest $request): JsonResponse
    {
        $data = $request->validated();
        
        Dimensi::create($data); // Create the Dimensi
        return response()->json(['message' => 'Data Dimensi berhasil ditambahkan']);
    }

    public function destroy(string $id){
        Dimensi::destroy($id);
        return response()->json(['message' => 'Data Dimensi berhasil dihapus']);
    }

    public function update(DimensiRequest $request, string $id){
        $data = $request->validated();
        Dimensi::find($id)->update($data); // Create the Dimensi
        return response()->json(['message' => 'Data Dimensi berhasil diperbarui']);
    }


    public function serversideTable(Request $request)
    {
        $dimensi = Dimensi::get();
        return DataTables::of($dimensi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<div>
                <button class="btn btn-sm btn-success" onclick="editModal(this)" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id . '">Hapus</button>
                 <a href="/elemen/' . $row->id . '" class="btn btn-sm btn-info">Kelola Elemen</a>
            </div>';
            })
            ->rawColumns(['aksi'])
            ->make();
    }
}