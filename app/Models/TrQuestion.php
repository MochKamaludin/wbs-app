<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class TrQuestion extends Model
{
    use LogsActivity;
    protected $table = 'trquestion';
    protected $primaryKey = 'i_id_question';
    public $timestamps = false;

    protected $fillable = [
        'c_wbls_categ',
        'c_question',
        'i_question_sort',
        'n_question',
        'f_required',
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

    public function choices()
    {
        return $this->hasMany(
            TrQuestionChoice::class,
            'i_id_question',
            'i_id_question'
        )->orderBy('i_choice_sort');
    }

    public function kategori()
    {
        return $this->belongsTo(
            ReferensiKategori::class,
            'c_wbls_categ',
            'c_wbls_categ'
        );
    }

    public function answers()
    {
        return $this->hasMany(TmAnswer::class, 'i_id_question');
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
