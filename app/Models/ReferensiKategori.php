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

    public function isAdmin()
    {
        return $this->c_wbls_admauth === "0";
    }

    public function isVerifikator()
    {
        return $this->c_wbls_admauth === "1";
    }

    public function isInvestigator()
    {
        return $this->c_wbls_admauth === "2";
    }
}
