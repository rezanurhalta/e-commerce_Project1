{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">

       <div class="login-card">
        <div class="login-header">
            <h1>Welcome</h1>
            <p>please login to your account</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control @error('email') is-invalid
            @enderror"
        id="email" name="email"  value="{{old('email')}}" placeholder="Enter your email"> 
        @error('email')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" @error('password') is-invalid
            @enderror
        id="password" name="password" value="{{old('password')}}" required autofocus placeholder="Enter your password">
        @error('email')
        <span class="invalid-feedback">{{$message}}</span>
        @enderror

       </div>
       <button type="submit" class="btn-login">Login</button>
       </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - School Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Membuat background abu-abu muda dan form di tengah */
        body {
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px; /* Lebar maksimal kotak login */
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
        }

        .btn-login {
            width: 100%;
            padding: 0.7rem;
            background-color: #0d6efd; /* Warna biru Bootstrap */
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 1rem;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #0b5ed7;
        }

        /* Menyesuaikan jarak antar form */
        .form-group {
            margin-bottom: 1.2rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header text-center mb-4">
            <h1>Welcome</h1>
            <p class="text-muted">Please login to your account</p>
            
            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 text-start" style="font-size: 0.9rem;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="nama@gmail.com" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" 
                       placeholder="Enter your password" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>