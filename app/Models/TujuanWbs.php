<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanWbs extends Model
{
    protected $table = 'tmwblspurpose';
    protected $primaryKey = 'i_wbls_purpose';
    public $timestamps = false;
    protected $casts = [
        'f_wbls_purposestat' => 'string',
    ];

    protected $fillable = [
        'n_wbls_purpose',
        'e_wbls_purpose',
        'c_wbls_purposeord',
        'f_wbls_purposestat',
        'i_wbls_adm',
        'd_wbls_purpose',
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
