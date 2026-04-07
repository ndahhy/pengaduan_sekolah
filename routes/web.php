<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KategoriController;

// Splash screen - landing page
Route::get('/', function () {
    return view('splash');
})->name('splash');

// Hardcoded admin login (development helper)
Route::get('/admin-login', function () {
    if (app()->environment('production')) {
        abort(404);
    }

    $admin = User::firstOrNew(['email' => 'admin@sekolah.com']);
    $admin->name = 'Admin Sekolah';
    $admin->nis = 'admin';
    $admin->kelas = 'Admin';
    $admin->role = 'admin';

    if (! $admin->exists) {
        $admin->password = Hash::make('admin123');
    }

    $admin->save();

    Auth::login($admin);
    request()->session()->regenerate();

    return redirect()->intended('/admin');
})->name('admin.login');

// Dashboard - protected route, redirect berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('aspirasi', AspirasiController::class);

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::post('/admin/status/{id}', [AdminController::class, 'updateStatus']);
        Route::post('/feedback', [FeedbackController::class, 'store']);
        Route::put('/feedback/{feedback}', [FeedbackController::class, 'update']);
        
        // Kategori routes
        Route::resource('kategori', KategoriController::class);
    });
});

require __DIR__.'/auth.php';