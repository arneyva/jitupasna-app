<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HSD extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'hsd';

    protected $fillable = ['tipe', 'nama', 'satuan', 'harga'];
}
