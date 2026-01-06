<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferensiStatus extends Model
{
    protected $table = 'trwblsstat';
    protected $primaryKey = 'c_wbls_stat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'c_wbls_stat',
        'n_wbls_stat',
        'e_wbls_stat',
    ];
}
