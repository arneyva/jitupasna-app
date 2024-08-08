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
        'kuantitas',
        'deskripsi',
    ];
    protected $dates = ['deleted_at'];
}
