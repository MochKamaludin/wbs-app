<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Faq extends Model
{
    use LogsActivity;
    protected $table = 'tmwblsfaq';
    protected $primaryKey = 'i_wbls_faq';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'i_wbls_faq',
        'e_wbls_faqquest',
        'e_wbls_faqans',
        'i_wbls_faqseq',
        'i_wbls_adm',
        'f_wbls_faqstat',
        'd_wbls_faq',
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
