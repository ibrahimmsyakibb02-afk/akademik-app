<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah pengguna sudah Login
        if (!$request->user()) {
            return redirect()->route('login');
        }
        // 2. Cek apakah role akun ada di daftar role yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki wewenang untuk halaman ini!');
        }
        return $next($request);
    }
}