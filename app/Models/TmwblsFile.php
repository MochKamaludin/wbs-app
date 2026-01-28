<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmwblsFile extends Model
{
    protected $table = 'tmwblsfile';
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['i_wbls', 'i_wbls_fileseq'];
    protected $keyType = 'array';

    protected $fillable = [
        'i_wbls',
        'i_wbls_fileseq',
        'n_wbls_file',
        'c_wbls_filecateg',
        'd_wbls_file',
    ];

    public function wbls()
    {
        return $this->belongsTo(
            Tmwbls::class,
            'i_wbls',
            'i_wbls'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            TrWblsFileCateg::class,
            'c_wbls_filecateg',
            'c_wbls_filecateg'
        );
    }
}
