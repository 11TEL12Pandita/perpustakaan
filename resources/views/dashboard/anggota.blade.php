<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0">Daftar Anggota</h4>
            <small class="text-muted">Semua anggota yang sudah mendaftar akun</small>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <p class="mb-2">Total anggota: <strong>{{ $members->count() }}</strong></p>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Anggota</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Username</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $index => $m)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $m->id_anggota ?? '-' }}</td>
                            <td>{{ $m->nis ?? '-' }}</td>
                            <td>{{ $m->nama ?? '-' }}</td>
                            <td>{{ $m->kelas ?? '-' }}</td>
                            <td>{{ $m->jurusan ?? '-' }}</td>
                            <td>{{ $m->username ?? '-' }}</td>
                            <td>{{ $m->created_at ? $m->created_at->format('Y-m-d') : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
