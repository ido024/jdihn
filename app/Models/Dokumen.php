<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use SoftDeletes;

    protected $table = 'dokumens';

    protected $fillable = [
        'jenis_dokuemn_id',
        'asal_dokumen',
        'nomor',
        'tahun',
        'judul',
        'teu',
        'singkatan_jenis',
        'tempat_terbit',
        'tgl_penetapan',
        'subyek',
        'status',
        'penandatanganan',
        'sumber',
        'bahasa',
        'abstrak',
        'document',
        'type_document',
        'size_document',
        'type_abstrak',
        'size_abstrak',
        'text_document',
        'kata_kunci'
    ];

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokuemn_id');
    }
}
