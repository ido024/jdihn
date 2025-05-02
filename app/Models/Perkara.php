<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perkara extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'penuntut_id',
        'hakim_id',
        'jaksa_id',
        'jenis_tindak_pidana_id',
        'nomor_perkara',
        'tanggal_pendaftaran',
        'nama_terdakwa',
        'tanggal_putusan',
        'alamat_terdakwa',
        'status_perkara',
    ];


    // public function penuntut()
    // {
    //     return $this->belongsTo(Penuntut::class, 'penuntut_id');
    // }

    /**
     * Get the hakim associated with the perkara.
     */
    public function hakim()
    {
        return $this->belongsTo(Hakim::class, 'hakim_id');
    }

    public function penuntut()
    {
        return $this->belongsTo(Penuntut::class, 'penuntut_id');
    }

    public function kategoritindakpidana()
    {
        return $this->belongsTo(KategoriTindakPidana::class, 'jenis_tindak_pidana_id');
    }

    /**
     * Get the jaksa associated with the perkara.
     */
    public function jaksa()
    {
        return $this->belongsTo(Jaksa::class, 'jaksa_id');
    }

    /**
     * Get the catatan_perkaras for the perkara.
     */
    public function catatan_perkaras()
    {
        return $this->hasMany(CatatanPerkara::class, 'perkara_id');
    }
}
