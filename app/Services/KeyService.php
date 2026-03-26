<?php
namespace App\Services;

use App\Models\EncryptionKey;

class KeyService
{
    public function getActiveKey(): EncryptionKey
    {
        return EncryptionKey::where('is_active', 1)->firstOrFail();
    }

    public function getKeyByVersion(string $version): EncryptionKey
    {
        return EncryptionKey::where('version', $version)->firstOrFail();
    }
}