<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset=”UTF-8″>
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
    <title>Register</title>
    <link href=”https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css” rel=”stylesheet”>
</head>
<body>

   <!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

```
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 400px;">

        <h3 class="text-center mb-4">Register</h3>

        <form action="/register" method="POST" class="mb-3">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" id="name" required>

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>

        <div class="text-center">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>

    </div>
</div>

</body>
</html>

