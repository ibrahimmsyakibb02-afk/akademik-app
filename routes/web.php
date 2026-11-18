<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Template HTML Wrapper agar semua halaman rapi dan konsisten
function renderTemplate($title, $role, $content) {
    return '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
        <style>
            body {
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f3f4f6;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .page-card {
                background: #ffffff;
                padding: 35px;
                border-radius: 12px;
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
                width: 100%;
                max-width: 480px;
                text-align: center;
            }
            .page-card h2 {
                margin-top: 0;
                color: #1f2937;
                font-size: 22px;
                margin-bottom: 10px;
            }
            .badge {
                display: inline-block;
                background-color: #e0f2fe;
                color: #0369a1;
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 15px;
            }
            .content-box {
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                padding: 15px;
                border-radius: 8px;
                color: #475569;
                font-size: 14px;
                margin-bottom: 25px;
                text-align: left;
            }
            .btn-group {
                display: flex;
                gap: 10px;
                justify-content: center;
            }
            .btn {
                background-color: #0284c7;
                color: white;
                text-decoration: none;
                padding: 9px 16px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                border: none;
                cursor: pointer;
                transition: background-color 0.2s;
            }
            .btn:hover {
                background-color: #0369a1;
            }
            .btn-logout {
                background-color: #ef4444;
            }
            .btn-logout:hover {
                background-color: #dc2626;
            }
        </style>
    </head>
    <body>
        <div class="page-card">
            <h2>' . $title . '</h2>
            <div><span class="badge">Role: ' . $role . '</span></div>
            <div class="content-box">' . $content . '</div>
            <div class="btn-group">
                <a href="/dashboard" class="btn">Dashboard</a>
                <form action="' . route('logout') . '" method="POST" style="margin:0;">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </body>
    </html>
    ';
}

// Halaman Utama otomatis diarahkan ke Login
Route::get('/', fn () => redirect()->route('login'));

// Rute Login & Logout (Publik)[cite: 34]
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// SEMUA RUTE DI BAWAH INI WAJIB LOGIN ('auth')[cite: 34]
Route::middleware(['auth'])->group(function () {
    
    // Dashboard umum[cite: 34]
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $htmlContent = "Halo, <b>{$user->name}</b>.<br>Anda berhasil masuk ke Sistem Akademik dengan hak akses yang diamankan menggunakan Middleware Laravel.";
        return renderTemplate("Dashboard Utama", $user->role, $htmlContent);
    })->name('dashboard');

    // Khusus Admin[cite: 34]
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/users', function() {
            $user = auth()->user();
            return renderTemplate("Manajemen User", $user->role, "Menu ini hanya dapat diakses secara eksklusif oleh akun ber-role <b>Admin</b> untuk mengelola data pengguna sistem.");
        });
    });

    // Khusus Dosen[cite: 34]
    Route::middleware(['role:dosen'])->group(function () {
        Route::get('/dosen/dashboard', function() {
            $user = auth()->user();
            return renderTemplate("Dashboard Dosen", $user->role, "Selamat datang, Dosen. Halaman ini dikhususkan untuk memantau proses pembelajaran dan aktivitas akademik.");
        });
    });

    // Khusus Mahasiswa[cite: 34]
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/nilai', function() {
            $user = auth()->user();
            return renderTemplate("Nilai Pribadi Mahasiswa", $user->role, "Halaman transkrip nilai akademik pribadi milik mahasiswa yang terlindungi dari akses luar.");
        });
    });

    // Gabungan: Admin DAN Dosen[cite: 34]
    Route::middleware(['role:admin,dosen'])->group(function () {
        Route::get('/kelola-materi', function() {
            $user = auth()->user();
            return renderTemplate("Kelola Materi Perkuliahan", $user->role, "Halaman manajemen materi pembelajaran ini dapat diakses bersama oleh <b>Admin</b> dan <b>Dosen</b>.");
        });
    });

});