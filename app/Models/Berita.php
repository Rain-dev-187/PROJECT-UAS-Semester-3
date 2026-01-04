<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    /**
     * Table name is singular 'berita' in migrations, set explicitly to avoid pluralization mismatch.
     */
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar',
        'kategori',
        'user_id',
        'status',
        'is_headline',
        'views',
        'published_at',
    ];

    protected $casts = [
        'is_headline' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul) . '-' . time();
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = Str::slug($berita->judul) . '-' . time();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeHeadline($query)
    {
        return $query->where('is_headline', true);
    }
}
