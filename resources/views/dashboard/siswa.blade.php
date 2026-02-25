<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-0">Dashboard Siswa</h4>
            <small class="text-muted">
                Selamat datang, {{ auth()->user()->nama_lengkap ?? session('username') ?? 'Siswa' }}
            </small>
        </div>

        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>

    </div>

    <!-- Menu -->
    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-plus-circle fs-1"></i>

                    <h5 class="mt-2">Pinjam Buku</h5>

                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm mt-2">
                        Pinjam
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-book fs-1"></i>

                    <h5 class="mt-2">Daftar Buku</h5>

                    <a href="{{ route('buku.index') }}" class="btn btn-success btn-sm mt-2">
                        Lihat
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-clock-history fs-1"></i>

                    <h5 class="mt-2">Riwayat Peminjaman</h5>

                    <a href="{{ route('transaksi.index') }}" class="btn btn-warning btn-sm mt-2">
                        Riwayat
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>