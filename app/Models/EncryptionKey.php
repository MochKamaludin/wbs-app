<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncryptionKey extends Model
{
    protected $fillable = [
        'key',
        'version',
        'is_active',
    ];
}
