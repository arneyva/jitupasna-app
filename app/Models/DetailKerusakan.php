<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailKerusakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detail_kerusakan';

    protected $fillable = ['kerusakan_id', 'hsd_id', 'kuantitas_per_satuan', 'harga', 'kuantitas_item'];

    protected $dates = ['deleted_at'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
    public function hsd()
    {
        return $this->belongsTo(HSD::class, 'hsd_id', 'id');
    }
}
