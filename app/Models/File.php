<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Casts\EncryptedCast;

class File extends Model
{
    protected $table = 'tmwblsfile';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;


    protected $casts = [
        'n_wbls_file' => EncryptedCast::class,
    ];

    protected $fillable = [
        'i_wbls',
        'i_wbls_fileseq',
        'i_id_question',
        'n_wbls_file',
        'i_wbls_checksum',
        'c_wbls_filecateg',
        'd_wbls_file',
    ];

    public function wbls()
    {
        return $this->belongsTo(
            Pengaduan::class,
            'i_wbls',
            'i_wbls'
        );
    }

    public function pertanyaan()
    {
        return $this->belongsTo(
            Pertanyaan::class,
            'i_id_question',
            'i_id_question'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            FileKategori::class,
            'c_wbls_filecateg',
            'c_wbls_filecateg'
        );
    }

    public function getDownloadUrlAttribute()
    {
        return Storage::url($this->n_wbls_file);
    }
}