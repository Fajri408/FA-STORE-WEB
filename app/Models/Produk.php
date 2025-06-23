<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama', 'deskripsi', 'stok', 'harga', 'kategori_id', 'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function adminDashboard()
    {
        $produks = Produk::with('kategori')->latest()->get(); // Ambil semua produk
        return view('admin.dashboard', compact('produks'));
    }
}
