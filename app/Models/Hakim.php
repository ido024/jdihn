<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hakim extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $fillable = [
        'nama_hakim',
        'nomor_telepon',
        'alamat_hakim',
        'email_hakim',
    ];
}
