<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4><i class="bi bi-plus-circle"></i> Pinjam Buku</h4>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </div>
    <!-- Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Success -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Form -->
    <div class="card shadow-sm">

        <div class="card-body">

            <form action="{{ route('transaksi.store') }}" method="POST">

                @csrf

                <!-- Buku -->
                <div class="mb-3">

                    <label class="form-label">Pilih Buku</label>

                    <select name="buku_id" class="form-select" required>

                        <option value="">-- Pilih Buku --</option>

                        @foreach($buku as $item)

                            @if($item->stok > 0)

                                <option value="{{ $item->id }}">
                                    {{ $item->judul_buku }} (Stok: {{ $item->stok }})
                                </option>

                            @endif

                        @endforeach

                    </select>

                </div>


                <!-- Tanggal -->
                <div class="mb-3">

                    <label class="form-label">Tanggal Pinjam</label>

                    <input type="date"
                        name="tanggal_pinjam"
                        class="form-control"
                        value="{{ date('Y-m-d') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">Tanggal Kembali</label>

                    <input type="date"
                        name="tanggal_kembali"
                        class="form-control"
                        value="{{ date('Y-m-d', strtotime('+7 days')) }}"
                        required>

                </div>

                <!-- Button -->
                <button class="btn btn-primary w-100">

                    <i class="bi bi-check-circle"></i>
                    Pinjam Buku

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>