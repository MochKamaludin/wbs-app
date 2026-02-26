<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\AesHelper;

class EncryptedCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? AesHelper::decrypt($value) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value ? AesHelper::encrypt($value) : null;
    }
}