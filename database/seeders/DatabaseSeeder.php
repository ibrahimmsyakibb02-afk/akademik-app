<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
public function run(): void
    {
// 1. Akun Admin
        User::create([
'name' => 'Pak Admin',
'email' => 'admin@gmail.com',
'password' => Hash::make('password123'),
'role' => 'admin',
        ]);
// 2. Akun Dosen
        User::create([
'name' => 'Bapak Dosen',
'email' => 'dosen@gmail.com',
'password' => Hash::make('password123'),
'role' => 'dosen',
        ]);
// 3. Akun Mahasiswa
        User::create([
'name' => 'Siswa Mahasiswa',
'email' => 'mahasiswa@gmail.com',
'password' => Hash::make('password123'),
'role' => 'mahasiswa',
        ]);
    }
}