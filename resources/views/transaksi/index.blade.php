<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">
            <i class="bi bi-book"></i> Riwayat Peminjaman
        </h5>

        <div>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Pinjam
            </a>

            <a href="{{ session('user_type') === 'admin' ? route('admin.dashboard') : route('siswa.dashboard') }}"
               class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Alert -->
    @foreach (['success' => 'success', 'error' => 'danger'] as $key => $color)
        @if(session($key))
            <div class="alert alert-{{ $color }} alert-dismissible fade show">
                {{ session($key) }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach


    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            @if($transaksi->count())

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead class="table-light">
                        <tr class="text-center">
                            <th>#</th>

                            @if(session('user_type') === 'admin')
                                <th class="text-start">Peminjam</th>
                            @endif

                            <th class="text-start">Buku</th>
                            <th>Pinjam</th>
                            <th>Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($transaksi as $item)
                        <tr class="text-center">

                            <td>{{ $loop->iteration }}</td>

                            @if(session('user_type') === 'admin')
                                <td class="text-start">
                                    {{ $item->user->nama ?? '-' }}
                                </td>
                            @endif

                            <td class="text-start">
                                <strong>{{ $item->buku->judul_buku ?? '-' }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $item->buku->pengarang ?? '' }}
                                </small>
                            </td>

                            <td>
                                {{ date('d M Y', strtotime($item->tanggal_pinjam)) }}
                            </td>

                            <td>
                                {{ $item->tanggal_kembali 
                                    ? date('d M Y', strtotime($item->tanggal_kembali)) 
                                    : '-' }}
                            </td>

                            <td>
                                @if($item->tanggal_kembali)
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @endif
                            </td>

                            <td>

                                @if(!$item->tanggal_kembali)

                                <form action="{{ route('transaksi.kembali', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-success btn-sm"
                                        onclick="return confirm('Kembalikan buku ini?')">

                                        <i class="bi bi-check-circle"></i> Kembalikan
                                    </button>
                                </form>

                                @else
                                    <span class="badge bg-success">Sudah Dikembalikan</span>
                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Tidak ada data
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

            @else

            <div class="text-center p-4 text-muted">
                Belum ada riwayat peminjaman
                <br>
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm mt-2">
                    Pinjam Buku
                </a>
            </div>

            @endif

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>