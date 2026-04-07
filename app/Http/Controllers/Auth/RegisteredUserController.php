<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan halaman register
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses register user
     */
    public function store(Request $request): RedirectResponse
    {
        // VALIDASI
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', 'unique:users'],
            'kelas' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // SIMPAN USER siswa saja
        $user = User::create([
            'name' => $request->name,
            'email' => $request->nis.'@siswa.local',
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'role' => 'siswa',
            'password' => Hash::make($request->password),
        ]);

        // EVENT REGISTER (opsional Laravel)
        event(new Registered($user));


        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}