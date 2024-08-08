<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
    use HasFactory;
    protected $table = 'bencana';

    protected $fillable = ['kategori_bencana_id', 'lokasi', 'deskripsi', 'tgl_mulai', 'tgl_selesai'];
    public function kategori_bencana()
    {
        return $this->belongsTo(KategoriBencana::class, 'kategori_bencana_id', 'id');
    }
}
