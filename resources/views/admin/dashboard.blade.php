<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin | FA STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">FA STORE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    {{-- Tombol Home --}}
                    <li class="nav-item me-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>

                    {{-- Dropdown Akun --}}
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person"></i> Profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Salam Admin --}}
        <div class="alert alert-info mb-3">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong>! Anda login sebagai <b>Admin</b>.
        </div>

        {{-- Form Tambah Kategori --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-tags"></i> Tambah Kategori
            </div>
            <div class="card-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kategori</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Simpan Kategori
                    </button>
                    </a>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-tags"></i> Lihat Kategori
                    </a>
                </form>
            </div>
        </div>

        {{-- Tabel Produk --}}
        <h2 class="mb-4">Data Produk</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('produk.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Produk
             </a>
        </div>

        @if($produks->isEmpty())
            <p class="text-center">Belum ada data produk.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            <tr>
                                <td>
                                    @if ($produk->gambar)
                                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" width="80">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus produk ini?')" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <footer class="text-center mt-5 text-muted">
        <small>&copy; {{ date('Y') }} FA STORE. All rights reserved.</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
