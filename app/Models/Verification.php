<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Verification extends Model
{
    protected $table = 'tmwblsvrf';

    protected $primaryKey = 'i_wbls_vrf';
    public $incrementing = true;
    public $timestamps = true;

        const CREATED_AT = 'd_wbls_vrf';
        const UPDATED_AT = 'd_wbls_vrf';

    protected $keyType = 'int';

    protected $fillable = [
        'i_wbls',
        'i_wbls_adm',
        'd_wbls_vrf',
        'f_wbls_usrname',
        'f_wbls_file',
        'i_wbls_bavrfseq',
        'i_wbls_bavrf'
    ];

    public function wbs()
    {
        return $this->belongsTo(Pengaduan::class, 'i_wbls', 'i_wbls');
    }

    public function answers()
    {
        return $this->hasMany(Jawaban::class, 'i_wbls', 'i_wbls');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'i_wbls', 'i_wbls');
    }

    public static function booted()
    {
        static::creating(function ($model) {
            $model->i_wbls_adm = Auth::user()->i_wbls_adm;
            $seq = (Verification::max('i_wbls_bavrfseq') ?? 0) + 1;
            $model->i_wbls_bavrfseq = $seq;
            $model->i_wbls_bavrf = 'BAV/' . str_pad($seq, 4, '0', STR_PAD_LEFT)
            . '/PTD/' . now()->format('m/Y');
        });

        static ::updating(function ($model) {
            $model->i_wbls_adm = Auth::user()->i_wbls_adm;
        });
    }
}