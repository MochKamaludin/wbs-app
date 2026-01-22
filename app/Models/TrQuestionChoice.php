<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class TrQuestionChoice extends Model
{
    use LogsActivity;
    protected $table = 'trquestionchoice';
    protected $primaryKey = 'i_id_questionchoice';
    public $timestamps = false;

    protected $fillable = [
        'i_id_question','i_choice_sort','n_choice',
        'f_active','i_entry','i_update'
    ];

    public function question()
    {
        return $this->belongsTo(TrQuestion::class, 'i_id_question');
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
