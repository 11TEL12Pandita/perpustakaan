<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>Data Buku</h4>

        <div>
            @if(session('user_type') === 'admin')
                <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Tambah Buku
                </a>
            @endif

            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Dashboard
            </a>
        </div>

    </div>

    <!-- Card -->
    <div class="card shadow">

        <div class="card-body">

            @if(count($buku) > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Stok</th>

                                @if(session('user_type') === 'admin')
                                    <th width="150">Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>

                        @foreach($buku as $key => $item)

                            <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $item->judul_buku ?? '-' }}</td>

                                <td>{{ $item->pengarang ?? '-' }}</td>

                                <td>{{ $item->penerbit ?? '-' }}</td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->stok }}
                                    </span>
                                </td>

                                @if(session('user_type') === 'admin')

                                <td>

                                    <a href="{{ route('buku.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <a href="{{ route('buku.destroy', $item->id) }}"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Hapus buku?')">

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </td>

                                @endif

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center p-4">

                    <i class="bi bi-inbox fs-1 text-secondary"></i>

                    <p class="mt-2">Belum ada data buku</p>

                </div>

            @endif

        </div>

    </div>

</div>

</body>
</html>