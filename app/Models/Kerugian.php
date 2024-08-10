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
        'bencana_id',
        'tipe',
        'nilai_ekonomi',
        'satuan',
        'kuantitas',
        'deskripsi',
    ];

    protected $dates = ['deleted_at'];
}
