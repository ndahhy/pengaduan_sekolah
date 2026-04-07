<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $admin = User::where('email', 'admin@sekolah.com')->first();

        if (! $admin) {
            User::create([
                'name' => 'Admin Sekolah',
                'email' => 'admin@sekolah.com',
                'nis' => 'admin',
                'kelas' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
            return;
        }

        if (! $admin->nis) {
            $admin->nis = 'admin';
            $admin->kelas = 'Admin';
            $admin->save();
        }
    }
}
