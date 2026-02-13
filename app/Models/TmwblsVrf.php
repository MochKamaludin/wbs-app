<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmwblsVrf extends Model
{
    protected $table = 'tmwblsvrf';

    protected $primaryKey = 'i_wbls';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'i_wbls',
        'i_wbls_adm',
        'd_wbls_vrf',
        'f_wbls_usrname',
        'f_wbls_file',
        'i_wbls_bavrfseq',
        'i_wbls_bavrf',
        'e_wbls_stat'
    ];

    public function wbs()
    {
        return $this->belongsTo(Tmwbls::class, 'i_wbls', 'i_wbls');
    }
}
