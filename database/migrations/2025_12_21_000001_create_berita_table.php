<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('berita')) {
            Schema::create('berita', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->string('slug')->unique();
                $table->text('ringkasan')->nullable();
                $table->longText('konten');
                $table->string('gambar')->nullable();
                $table->string('kategori')->default('umum');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
                $table->boolean('is_headline')->default(false);
                $table->integer('views')->default(0);
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
