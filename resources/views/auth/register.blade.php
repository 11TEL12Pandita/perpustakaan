<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow p-4" style="width: 400px;">

    <h4 class="text-center mb-3">Register Perpustakaan</h4>

    @if ($errors->any())
        <div class="alert alert-danger p-2">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('prosesRegister') }}" method="POST">
        @csrf

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label">Daftar sebagai</label>
            <h5 class="text-center mb-3">Siswa</h5>
        </div>

        <!-- Form Siswa -->
        <div id="formSiswa">

            <div class="mb-2">
                <input type="text" name="nis" class="form-control" placeholder="NIS">
            </div>

            <div class="mb-2">
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama lengkap">
            </div>

            <div class="row">
                <div class="col">
                    <select name="kelas" class="form-select">
                        <option value="">Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>

                <div class="col">
                    <select name="jurusan" class="form-select">
                        <option value="">Jurusan</option>
                        <option value="TR">TR</option>
                        <option value="TJA">TJA</option>
                        <option value="TKJ">TKJ</option>
                        <option value="RPL">RPL</option>
                    </select>
                </div>
            </div>

        </div>

        <!-- Umum -->
        <div class="mb-2">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <div class="mb-2">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        </div>

        <button class="btn btn-success w-100">Register</button>

    </form>

    <div class="text-center mt-3">
        <small>
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </small>
    </div>

</div>

<script>
document.getElementById('role').onchange = function() {
    document.getElementById('formSiswa').style.display =
        this.value === 'siswa' ? 'block' : 'none';
}
</script>

</body>
</html>