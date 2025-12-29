<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefinisiWbs extends Model
{
    protected $table = 'tmwblsabout';
    protected $primaryKey = 'i_wbls_about';
    public $timestamps = false;

    protected $fillable = [
        'n_wbls_about',
        'e_wbls_about',
        'i_wbls_adm',
        'd_wbls_about',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'i_wbls_adm', 'i_wbls_adm');
    }
}
