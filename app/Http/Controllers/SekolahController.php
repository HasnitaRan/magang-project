<?php

namespace App\Http\Controllers;

use App\Models\Sekolah; 

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


}