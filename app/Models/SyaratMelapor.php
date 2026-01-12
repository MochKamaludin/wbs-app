<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratMelapor extends Model
{
    protected $table = 'tmwblsreq';
    protected $primaryKey = 'i_wbls_req';
    public $timestamps = false;

    protected $fillable = [
        'n_wbls_req',
        'e_wbls_req',
        'c_wbls_reqord',
        'f_wbls_reqstat',
        'i_wbls_adm',
        'd_entry',
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
