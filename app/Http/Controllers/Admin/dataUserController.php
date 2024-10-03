<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class dataUserController extends Controller
{
    public function index(): View
    {

        return view('admin.dataUser.dataUser');
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(string $id): JsonResponse{
        return response()->json([
            'data' => User::find($id)
        ]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password); // Hash password
        User::create($data); // Create the user
        return response()->json(['message' => 'Data user berhasil ditambahkan']);
    }

    public function destroy(string $id){
        User::destroy($id);
        return response()->json(['message' => 'Data user berhasil dihapus']);
    }

    public function update(UserRequest $request, string $id){
        $data = $request->validated();
        $data['password'] = Hash::make($request->password); // Hash password
        User::find($id)->update($data); // Create the user
        return response()->json(['message' => 'Data user berhasil diperbarui']);
    }


    public function serversideTable(Request $request)
    {
        $user = User::get();
        return DataTables::of($user)
            ->addIndexColumn()
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