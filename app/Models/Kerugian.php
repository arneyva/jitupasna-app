<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerugian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kerugian';

    protected $fillable = [
        'Ref',
        'bencana_id',
        'tipe',
        'nilai_ekonomi',
        'satuan_id',
        'kuantitas',
        'deskripsi',
        'BiayaKeseluruhan',
    ];

    protected $dates = ['deleted_at'];

    public function bencana()
    {
        return $this->belongsTo(Bencana::class, 'bencana_id', 'id');
    }
}
