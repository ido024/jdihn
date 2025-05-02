<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisDokumen extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_dokumens';

    protected $fillable = [
        'produk_hukum_id',
        'nama',
        'jumlah',
    ];

    public function produkHukum()
    {
        return $this->belongsTo(ProdukHukum::class, 'produk_hukum_id');
    }

    public function documents()
    {
        return $this->hasMany(Dokumen::class, 'jenis_dokuemn_id'); // typo tetap disesuaikan dengan kolom yang ada
    }
}
