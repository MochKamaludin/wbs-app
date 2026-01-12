<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'tmwblsfaq';
    protected $primaryKey = 'i_wbls_faq';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'i_wbls_faq',
        'e_wbls_faqquest',
        'e_wbls_faqans',
        'i_wbls_faqseq',
        'i_wbls_adm',
        'f_wbls_faqstat',
        'd_wbls_faq',
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
