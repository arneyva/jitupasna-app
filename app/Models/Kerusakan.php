<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerusakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kerusakan';

    protected $fillable = [
        'bencana_id',
        'kategori_kerusakan_id',
        'Ref',
        'deskripsi',
        'BiayaKeseluruhan',
    ];

    protected $dates = ['deleted_at'];

    public function detail()
    {
        return $this->hasMany(DetailKerusakan::class, 'kerusakan_id', 'id');
    }

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id', 'id');
    }

    public function kategori_bangunan()
    {
        return $this->belongsTo(KategoriBangunan::class, 'kategori_bangunan_id', 'id');
    }
}
