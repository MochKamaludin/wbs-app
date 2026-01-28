<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tmwbls extends Model
{
    protected $table = 'tmwbls';
    protected $primaryKey = 'i_wbls';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'i_wbls',
        'i_wbls_seq',
        'c_wbls_categ',
        'e_wbls',
        'd_wbls_incident',
        'c_wbls_stat',
        'd_wbls',
        'd_entry',
    ];

    public function files()
    {
        return $this->hasMany(
            TmwblsFile::class,
            'i_wbls',
            'i_wbls'
        );
    }
}
