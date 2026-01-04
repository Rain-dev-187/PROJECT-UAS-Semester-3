<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PULSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #3d5a80;
            --accent: #ee6c4d;
            --light: #e0fbfc;
        }
        body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--primary),var(--secondary));font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif}
        .login-card{background:#fff;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,0.3);overflow:hidden;max-width:420px;width:100%}
        .login-header{background:linear-gradient(135deg,var(--primary),var(--secondary));padding:30px;text-align:center;color:#fff}
        .login-header h2{font-weight:800;margin-bottom:5px}
        .login-header p{opacity:0.9;margin:0;font-size:0.95rem}
        .login-body{padding:30px}
        .form-label{font-weight:600;color:var(--primary)}
        .form-control{border:2px solid #e9ecef;border-radius:10px;padding:12px 15px}
        .btn-login{background:linear-gradient(135deg,var(--primary),var(--secondary));border:none;padding:12px;border-radius:10px;font-weight:600}
        .info-box{background:var(--light);border-radius:10px;padding:12px;margin-bottom:15px;border-left:4px solid var(--primary)}
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>PULSA</h2>
            <p>Daftar Akun Baru</p>
        </div>
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
            @endif

            <div class="info-box">
                <small>Isi data di bawah untuk membuat akun. Setelah mendaftar Anda akan otomatis masuk sebagai `user`.</small>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-login btn-primary w-100 mb-3" type="submit">Daftar</button>

                <div class="text-center">
                    <a href="{{ route('login') }}" style="color:var(--primary)">Sudah punya akun? Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
