<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\AesHelper;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Pengaduan extends Model
{
    use LogsActivity;

    protected $table = 'tmwbls';
    protected $primaryKey = 'i_wbls';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $encrypted = [
        'n_wbls_categother',
        'e_wbls',
        'i_wbls_adm',
        'd_wbls_incident',
        'e_wbls_stat',
    ];

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

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encrypted) && !is_null($value)) {
            $value = AesHelper::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encrypted) && !is_null($value)) {
            try {
                return AesHelper::decrypt($value);
            } catch (\Exception $e) {
                return $value;
            }
        }

        return $value;
    }

    public function files()
    {
        return $this->hasMany(File::class, 'i_wbls', 'i_wbls');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'i_wbls', 'i_wbls');
    }

    public function investigation()
    {
        return $this->hasOne(Investigation::class, 'i_wbls', 'i_wbls');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'i_wbls_adm');
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