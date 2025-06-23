<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom gambar ke tabel produks.
     */
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('harga');
        });
    }

    /**
     * Menghapus kolom gambar dari tabel produks jika rollback.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
