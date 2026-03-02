<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Casts\EncryptedCast;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Jawaban extends Model
{
    use LogsActivity;

    protected $table = 'tmanswer';
    protected $primaryKey = 'i_id_answer';
    public $timestamps = false;


    protected $casts = [
        'e_answer' => EncryptedCast::class,
        'i_entry'  => EncryptedCast::class,
    ];

    protected $fillable = [
        'i_wbls',
        'i_id_question',
        'i_id_questionchoice',
        'e_answer',
        'i_entry',
        'd_entry',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(
            Pertanyaan::class,
            'i_id_question'
        );
    }

    public function choice()
    {
        return $this->belongsTo(
            PilihanPertanyaan::class,
            'i_id_questionchoice',
            'i_id_questionchoice'
        );
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