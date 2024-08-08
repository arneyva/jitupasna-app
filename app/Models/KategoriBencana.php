<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriBencana extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_bencana';

    protected $fillable = ['nama', 'deskripsi'];

    protected $dates = ['deleted_at'];
}
