<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiKategori extends Model
{
    protected $table = 'trwblscateg';
    protected $primaryKey = 'c_wbls_categ';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'c_wbls_categ',
        'n_wbls_categ',
        'e_wbls_categ',
    ];
}
