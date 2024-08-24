<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desa extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'desa';

    protected $fillable = ['kecamatan_id','nama','kode_pos'];
    public function bencana()
    {
        return $this->belongsToMany(Bencana::class, 'wilayah_bencana', 'desa_id', 'bencana_id');
    }
}
