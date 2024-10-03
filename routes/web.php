<?php

use App\Http\Controllers\Admin\dataGuruController;
use App\Http\Controllers\Admin\dataSiswaController;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\Admin\dataUserController;


Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome');
    } else {
        return redirect()->route('login');
    }
});


Route::get('/dashboard', function () {
    $user = Auth::user();


    switch ($user->role) {
        case 'admin':
            return redirect()->route('dashboard.admin');
        case 'guru':
            return redirect()->route('dashboard.guru');
        case 'siswa':
            return redirect()->route('dashboard.siswa');
        default:
            return redirect('/');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    //menu data sekolah
    Route::get('admin/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
    Route::get('/sekolah/edit/{id}', [SekolahController::class, 'edit'])->name('sekolah.edit');
    Route::put('/sekolah/update/{id}', [SekolahController::class, 'update'])->name('sekolah.update');

    //menu data user
    Route::get('/users', [dataUserController::class, 'serversideTable']); // get data
    Route::resource('admin/users', dataUserController::class)->except(['create', 'edit']);

    //menu data guru
    Route::get('/gurus', [dataGuruController::class, 'serversideTable']); // get data
    Route::resource('admin/guru', dataGuruController::class)->except(['create', 'edit']);

    //menu data guru
    Route::get('/siswas', [dataSiswaController::class, 'serversideTable']); // get data
    Route::resource('admin/siswa', dataSiswaController::class)->except(['create', 'edit']);



});


Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('dashboard.guru');

});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard.siswa');

});


require __DIR__.'/auth.php';