<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriTindakPidana extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_kategori_pidana',
        'nama_kategori',
    ];
    
}
