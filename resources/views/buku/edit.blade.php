<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Edit Buku</h4>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('buku.update', $buku->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ old('judul', $buku->judul) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengarang</label>
                    <input type="text"
                           name="pengarang"
                           class="form-control"
                           value="{{ old('pengarang', $buku->pengarang) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit</label>
                    <input type="text"
                           name="penerbit"
                           class="form-control"
                           value="{{ old('penerbit', $buku->penerbit) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ISBN</label>
                    <input type="text"
                           name="isbn"
                           class="form-control"
                           value="{{ old('isbn', $buku->isbn) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number"
                           name="tahun_terbit"
                           class="form-control"
                           value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old('stok', $buku->stok) }}"
                           required>
                </div>

                <button class="btn btn-primary w-100">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>