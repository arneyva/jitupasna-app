<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriKerusakan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kategori_kerusakan';
    protected $fillable = ['nama', 'level', 'deskripsi'];
    protected $dates = ['deleted_at'];
}
