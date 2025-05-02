<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penuntut extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_tuntutan',
        'nama_penuntut',
        'nama_terdakwa',
        'umur_terdakwa',
        'tgl_tuntutan',
        'no_hp_penuntut',
        'alamat_penuntut',
        'kasus_dugaan',
        'bukti_foto1',
        'bukti_foto2',
        'bukti_foto3',
        'bukti_foto4',
        'bukti_foto5',
    ];

    public function getBuktiFoto1UrlAttribute()
    {
        return $this->getUrlAttribute($this->bukti_foto1);
    }

    public function getBuktiFoto2UrlAttribute()
    {
        return $this->getUrlAttribute($this->bukti_foto2);
    }

    public function getBuktiFoto3UrlAttribute()
    {
        return $this->getUrlAttribute($this->bukti_foto3);
    }

    public function getBuktiFoto4UrlAttribute()
    {
        return $this->getUrlAttribute($this->bukti_foto4);
    }

    public function getBuktiFoto5UrlAttribute()
    {
        return $this->getUrlAttribute($this->bukti_foto5);
    }
}
