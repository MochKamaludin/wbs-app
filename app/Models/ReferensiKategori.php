<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class ReferensiKategori extends Model
{
    use LogsActivity;
    protected $table = 'trwblscateg';
    protected $primaryKey = 'c_wbls_categ';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'c_wbls_categ',
        'n_wbls_categ',
        'e_wbls_categ',
    ];

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

    public function getActivitylogOptions(): LogOptions
    {
        $user = Auth::user();
        $logName = 'default';
        
        if ($user) {
            $logName = match($user->c_wbls_admauth) {
                '0' => 'admin_activity',
                '1' => 'verifikator_activity',
                '2' => 'investigator_activity',
                default => 'default',
            };
        }

        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($logName);
    }
}
