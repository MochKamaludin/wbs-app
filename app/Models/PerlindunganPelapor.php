<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerlindunganPelapor extends Model
{
    protected $table = 'tmwblsprotect';
    protected $primaryKey = 'i_wbls_protect';
    public $timestamps = false;

    protected $fillable = [
        'n_wbls_protect',
        'e_wbls_protect',
        'c_wbls_protectord',
        'f_wbls_protectstat',
        'i_wbls_adm',
        'd_wbls_protect',
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
