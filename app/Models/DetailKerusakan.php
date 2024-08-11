<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailKerusakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_kerusakan';

    protected $fillable = ['kerusakan_id', 'tipe', 'nama', 'kuantitas', 'satuan', 'harga'];

    protected $dates = ['deleted_at'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
