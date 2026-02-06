<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmwblsResume extends Model
{
    protected $table = 'tmwblsresume';

    public $timestamps = false;

    protected $fillable = [
        'i_wbls',
        'e_wbls_resume',
        'i_wbls_adm',
        'd_wbls_resume',
        'i_wbls_bainvest',
        'i_wbls_bainvestseq',
        'd_wbls_bainvest',
    ];

    public function wbls()
    {
        return $this->belongsTo(
            Tmwbls::class,
            'i_wbls',
            'i_wbls'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'i_wbls_adm',
            'i_wbls_adm'
        );
    }
}
