<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WilayahBencana extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wilayah_bencana';

    protected $fillable = ['bencana_id', 'desa_id'];
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }
}
