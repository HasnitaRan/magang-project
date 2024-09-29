<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\dataUserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
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

    //menu data siswa
    Route::get('admin/users', [dataUserController::class, 'index'])->name('admin.users.index'); // View all users
    Route::get('admin/users/create', [dataUserController::class, 'create'])->name('admin.users.create'); // Form to create user
    Route::post('admin/users', [dataUserController::class, 'store'])->name('admin.users.store'); // Save new user
    Route::get('admin/users/{user}/edit', [dataUserController::class, 'edit'])->name('admin.users.edit'); // Form to edit user
    Route::put('admin/users/{user}', [dataUserController::class, 'update'])->name('admin.users.update'); // Update user
    Route::delete('admin/users/{user}', [dataUserController::class, 'destroy'])->name('admin.users.destroy'); // Delete user

});


Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('dashboard.guru');

});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard.siswa');

});


require __DIR__.'/auth.php';
