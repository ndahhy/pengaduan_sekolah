<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('aspirasis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('kategori_id')->constrained()->cascadeOnDelete();

    $table->string('judul');
    $table->text('isi');
    $table->enum('status', ['pending','proses','selesai'])->default('pending');
    $table->date('tanggal');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};