<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use App\Models\TrQuestion;

class TrQuestionChoice extends Model
{
    use LogsActivity;
    protected $table = 'trquestionchoice';

    protected $primaryKey = 'i_id_questionchoice'; 

    public $timestamps = false;

    protected $fillable = [
        'i_id_question',
        'n_choice',
        'i_choice_sort',
        'f_active',
        'i_entry',
        'd_entry',
        'i_update',
        'd_update',
    ];

    protected $casts = [
        'd_entry'  => 'datetime',
        'd_update' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $user = Auth::user();
            $model->i_entry = $user?->i_wbls_adm_id ?? 0;
            $model->d_entry = now();
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->i_update = $user?->i_wbls_adm_id ?? 0;
            $model->d_update = now();
        });
    }

    public function question()
    {
        return $this->belongsTo(TrQuestion::class, 'i_id_question');
    }

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
