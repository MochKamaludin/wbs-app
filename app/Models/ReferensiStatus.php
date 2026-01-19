<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReferensiStatus extends Model
{
    use LogsActivity;
    protected $table = 'trwblsstat';
    protected $primaryKey = 'c_wbls_stat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'c_wbls_stat',
        'n_wbls_stat',
        'e_wbls_stat',
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
        $user = auth()->user();
        $logName = 'default';
        
        if ($user) {
            $logName = match($user->c_wbls_admauth) {
                '0' => 'admin_activity',
                '1' => 'operator_activity',
                '2' => 'verifikator_activity',
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
