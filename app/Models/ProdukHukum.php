<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukHukum extends Model
{
    use SoftDeletes;

    protected $table = 'produk_hukums';

    protected $fillable = [
        'nama',
        'jumlah',
    ];

    public function jenisDokumens()
    {
        return $this->hasMany(JenisDokumen::class, 'produk_hukum_id');
    }
}
