<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sekolah.home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sekolah.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'nama_sekolah' => 'required',
            'nipsn' => 'required',
            'jalan' => 'required',
            'desa_kelurahan' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'kode_pos' => 'required',
            'no_telp' => 'required',
            'website' => 'required',
            'email' => 'required',
            'kepala_sekolah' => 'required',
            'nip_kepsek' => 'required',
            'logo_sekolah' => 'required',


        ]);
        $data = Sekolah::create($validation);
        if ($data) {
            session()->flash('success', 'Data Add Successfully');
            return redirect(route('admin/sekolah'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.sekolah/create'));
        }
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sekolah $sekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}
