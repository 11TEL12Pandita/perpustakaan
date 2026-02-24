<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow p-4" style="width: 350px;">
    
    <h4 class="text-center mb-3">Perpustakaan</h4>

    @if ($errors->any())
        <div class="alert alert-danger p-2">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('prosesLogin') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" name="username" class="form-control" 
                placeholder="Username" value="{{ old('username') }}" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" 
                placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>

    </form>

    <div class="text-center mt-3">
        <small>
            Belum punya akun? 
            <a href="{{ route('register') }}">Daftar</a>
        </small>
    </div>

</div>

</body>
</html>