<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrWblsFileCateg extends Model
{
    protected $table = 'trwblsfilecateg';
    public $timestamps = false;
    protected $primaryKey = 'c_wbls_filecateg';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'c_wbls_filecateg',
        'n_wbls_filecateg',
        'e_wbls_filecateg',
    ];

    public function files()
    {
        return $this->hasMany(
            TmwblsFile::class,
            'c_wbls_filecateg',
            'c_wbls_filecateg'
        );
    }
}
