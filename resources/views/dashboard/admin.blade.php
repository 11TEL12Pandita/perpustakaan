<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-0">Dashboard Admin</h4>
            <small class="text-muted">
                Selamat datang, {{ session('username') ?? 'Admin' }}
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

                    <i class="bi bi-people fs-1"></i>

                    <h5 class="mt-2">Data Anggota</h5>

                    <div class="mt-2">
                        <span class="badge bg-primary fs-6">Total: {{ $members_count ?? 0 }}</span>
                    </div>

                    <a href="{{ route('admin.anggota') }}" class="btn btn-primary btn-sm mt-2">
                        Buka
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-book fs-1"></i>

                    <h5 class="mt-2">Data Buku</h5>

                    <a href="{{ route('buku.index') }}" class="btn btn-success btn-sm mt-2">
                        Buka
                    </a>

                </div>

            </div>

        </div>


        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-arrow-left-right fs-1"></i>

                    <h5 class="mt-2">Data Transaksi</h5>

                    <a href="{{ route('transaksi.index') }}" class="btn btn-warning btn-sm mt-2">
                        Buka
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>