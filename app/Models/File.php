<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $table = 'tmwblsfile';
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['i_wbls', 'i_wbls_fileseq'];
    protected $keyType = 'array';

    protected $fillable = [
        'i_wbls',
        'i_wbls_fileseq',
        'n_wbls_file',
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

    
    public function getDownloadUrlAttribute()
    {
        return Storage::url($this->n_wbls_file);
    }

    public function category()
    {
        return $this->belongsTo(
            FileKategori::class,
            'c_wbls_filecateg',
            'c_wbls_filecateg'
        );
    }
}
