<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Services\EncryptionService;
use App\Services\KeyService;

class EncryptedCast implements CastsAttributes
{
    protected EncryptionService $service;

    public function __construct()
    {
        $this->service = new EncryptionService(new KeyService());
    }

    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? $this->service->decrypt($value) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value ? $this->service->encrypt($value) : null;
    }
}