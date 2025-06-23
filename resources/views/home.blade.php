<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FA STORE - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial, sans-serif; }
        .hero {
            padding: 80px 0;
            text-align: center;
            background: #f8f9fa;
        }
        .image-gallery {
            padding: 50px 0;
        }
        .image-gallery img {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .product-card img {
            height: 200px;
            object-fit: cover;
        }
        .contact {
            background-color: #f8f9fa;
            padding: 60px 0;
        }
        footer {
            background-color: #212529;
            color: #fff;
            padding: 20px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">FA STORE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>

                @guest
                    <!-- Jika belum login -->
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <!-- Jika sudah login -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4">Selamat Datang di FA STORE</h1>
            <p class="lead">Temukan iPhone dan Aksesori Terbaik dengan Harga Terjangkau</p>
        </div>
    </section>

    <!-- Image Gallery -->
    <section class="image-gallery container">
        <div class="row">
            <div class="col-md-4">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-model-unselect-gallery-1-202309?wid=5120&hei=2880" alt="iPhone 15 Pro">
            </div>
            <div class="col-md-4">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-model-unselect-gallery-2-202309?wid=5120&hei=2880" alt="iPhone Accessories">
            </div>
            <div class="col-md-4">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-model-unselect-gallery-1-202309?wid=5120&hei=2880" alt="iPhone 15 Pro">

            </div>
        </div>
    </section>

    <!-- Produk Tersedia -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Produk Tersedia</h2>
        <div class="row">
            @forelse ($produks as $produk)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm product-card">
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama }}</h5>
                            <p class="card-text">
                                <strong>Kategori:</strong> {{ $produk->kategori->nama ?? '-' }}<br>
                                <strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}<br>
                                <strong>Stok:</strong> {{ $produk->stok }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="text-center mb-4">Hubungi Kami</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <p><strong>Email:</strong> info@fastore.com</p>
                    <p><strong>WhatsApp:</strong> 0812-3456-7890</p>
                    <p><strong>Alamat:</strong> Jl. Teknologi No. 88, Jakarta</p>
                    <p>Atau kunjungi kami di Instagram <a href="https://instagram.com/fastore" target="_blank">@fastore</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} FA STORE. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
