<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

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
        'n_wbls_categother',
        'e_wbls',
        'd_wbls_incident',
        'c_wbls_stat',
        'd_wbls',
        'd_entry',
        'f_wbls_agree',
        'i_wbls_adm',
        'd_wbls_check',
        'e_wbls_stat',
    ];

    public function files()
    {
        return $this->hasMany(
            TmwblsFile::class,
            'i_wbls',
            'i_wbls'
        );
    }

    public function kategori()
    {
        return $this->belongsTo(
            ReferensiKategori::class,
            'c_wbls_categ',
        );
    }

    public function status()
    {
        return $this->belongsTo(
            ReferensiStatus::class,
            'c_wbls_stat',
        );
    }

    public function resume()
    {
        return $this->hasOne(TmwblsResume::class, 'i_wbls', 'i_wbls');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'i_wbls', 'i_wbls');
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'i_wbls_adm',
        );
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
