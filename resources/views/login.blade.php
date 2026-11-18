<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Akademik</title>
    <style>
        /* CSS Styling untuk Halaman Login */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }

        .login-card h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #1f2937;
            text-align: center;
            font-size: 22px;
        }

        .error-message {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 11px;
            background-color: #0284c7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #0369a1;
        }

        .credentials-hint {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
        }

        .credentials-hint b {
            color: #374151;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3>Login Akademik</h3>

        <!-- Menampilkan Pesan Error Jika Gagal Login -->
        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="contoh: admin@gmail.com" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
        </form>

        <!-- Informasi Akun Uji Coba untuk Mempermudah Tugas -->
        <div class="credentials-hint">
            <b>Akun Uji Coba:</b><br>
            • Admin: <code>admin@gmail.com</code><br>
            • Dosen: <code>dosen@gmail.com</code><br>
            • Mhs: <code>mahasiswa@gmail.com</code><br>
            <i>Password (semua): password123</i>
        </div>
    </div>

</body>
</html>