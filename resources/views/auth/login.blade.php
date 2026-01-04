<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin PULSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a5f;
            --secondary: #3d5a80;
            --accent: #ee6c4d;
            --light: #e0fbfc;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            text-align: center;
            color: #fff;
        }
        
        .login-header h2 { font-weight: 800; margin-bottom: 5px; }
        .login-header p { opacity: 0.8; margin: 0; font-size: 0.9rem; }
        
        .login-body { padding: 40px; }
        
        .form-label { font-weight: 600; color: var(--primary); }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
        }
        
        .input-group-text {
            background: var(--light);
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--primary);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(30, 58, 95, 0.4);
        }
        
        .back-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .back-link:hover { color: var(--accent); }
        
        .alert { border: none; border-radius: 10px; }

        .info-box {
            background: var(--light);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>PULSA</h2>
        </div>
        
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="info-box">
                <small><strong>Demo Login:</strong><br>
                Admin: admin@pulsa.id / password<br>
                Staff: staff@pulsa.id / password</small>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" 
                               placeholder="Masukkan password" required>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login btn-primary w-100 mb-4">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
                
                <div class="text-center">
                    <a href="{{ route('home') }}" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Website
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
