<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PihakTerlibat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'perkara_id',
        'no_pihak_t',
        'nama_pihak',
        'alamat',
        'tipe_pihak',
        'no_hp_pihak_terlibat',
        'file_1',
        'type_1',
        'size_1',
    ];

    // Relationship to Perkara
    public function perkara()
    {
        return $this->belongsTo(Perkara::class, 'perkara_id');
    }
}
