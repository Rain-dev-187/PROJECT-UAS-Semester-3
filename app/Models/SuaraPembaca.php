<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuaraPembaca extends Model
{
    use HasFactory;

    /**
     * Table name is singular 'suara_pembaca' in migrations, set explicitly to avoid pluralization mismatch.
     */
    protected $table = 'suara_pembaca';

    protected $fillable = [
        'nama',
        'email',
        'foto',
        'profesi',
        'pesan',
        'status',
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
