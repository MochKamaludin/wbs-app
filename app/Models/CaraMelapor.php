<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaraMelapor extends Model
{
    protected $table = 'tmwblsproc';
    protected $primaryKey = 'i_wbls_proc';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'n_wbls_proc',
        'e_wbls_proc',
        'c_wbls_procord',
        'f_wbls_procstat',
        'i_wbls_adm',
        'd_wbls_proc',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'i_wbls_adm', 'i_wbls_adm');
    }

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
