<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class Investigation extends Model
{
    protected $table = 'tmwblsresume';

    public $timestamps = true;

    const CREATED_AT = 'd_wbls_resume';
    const UPDATED_AT = 'd_wbls_resume';

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

    protected static function booted()
    {
        static::creating(function ($model) {

            $seq = (Investigation::max('i_wbls_bainvestseq') ?? 0) + 1;

            $model->i_wbls_adm = Auth::user()->i_wbls_adm;
            $model->i_wbls_bainvestseq = $seq;

            $model->i_wbls_bainvest = 'BAI/' . str_pad($seq, 4, '0', STR_PAD_LEFT)
            . '/PTD/' . now()->format('m/Y');

            $model->d_wbls_bainvest = now();
        });

        static::updating(function ($model) {
            $model->i_wbls_adm = Auth::user()->i_wbls_adm;
        });
    }
}
