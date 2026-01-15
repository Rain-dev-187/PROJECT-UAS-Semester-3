<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Opini extends Model
{
    use HasFactory;

    /**
     * Table name is singular 'opini' in migrations, set explicitly to avoid pluralization mismatch.
     */
    protected $table = 'opini';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'penulis_nama',
        'penulis_email',
        'penulis_foto',
        'penulis_profesi',
        'user_id',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function ($opini) {
            $opini->slug = Str::slug($opini->judul) . '-' . time();
        });

        static::updating(function ($opini) {
            if ($opini->isDirty('judul')) {
                $opini->slug = Str::slug($opini->judul) . '-' . time();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
