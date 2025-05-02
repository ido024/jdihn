<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sidang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'perkara_id',
        'tgl_sidang',
        'waktu_mulai',
        'waktu_selesai',
        'ruang_sidang',
    ];

    public function perkara()
    {
        return $this->belongsTo(Perkara::class, 'perkara_id');
    }
}
