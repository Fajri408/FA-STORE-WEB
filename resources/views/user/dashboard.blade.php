{{-- resources/views/user/dashboard.blade.php --}}
<x-app-layout>

@section('title', 'User Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">User Dashboard</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="alert alert-info">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>! Anda login sebagai <b>User</b>.
    </div>

    <div class="mb-3">
        <a href="{{ route('produk.index') }}" class="btn btn-primary me-2">Lihat Produk</a>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Lihat Kategori</a>
    </div>
    <hr>
    <p>
        <b>Menu User:</b>
        <ul>
            <li>daftar produk</li>
            <li>kategori produk</li>
            <li>Tidak dapat mengelola data</li>
        </ul>
    </p>
</div>
@endsection
</x-app-layout>