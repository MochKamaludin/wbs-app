<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class SyaratMelapor extends Model
{
    use LogsActivity;
    protected $table = 'tmwblsreq';
    protected $primaryKey = 'i_wbls_req';
    public $timestamps = false;

    protected $fillable = [
        'n_wbls_req',
        'e_wbls_req',
        'c_wbls_reqord',
        'f_wbls_reqstat',
        'i_wbls_adm',
        'd_entry',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'i_wbls_adm', 'i_wbls_adm');
    }

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
