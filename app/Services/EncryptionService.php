<?php

namespace App\Services;

class EncryptionService
{
    private const CIPHER = 'aes-256-gcm';

    public function __construct(
        protected KeyService $keyService
    ) {}

    private function generateKey(string $rawKey): string
    {
        return hash('sha256', $rawKey, true);
    }

    public function encrypt(?string $plainText): ?string
    {
        if (!$plainText) return null;

        $keyData = $this->keyService->getActiveKey();
        $key = $this->generateKey($keyData->key);

        $iv = random_bytes(12);

        $cipherText = openssl_encrypt(
            $plainText,
            self::CIPHER,
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        return json_encode([
            'v' => $keyData->version,
            'd' => base64_encode($iv . $tag . $cipherText),
        ]);
    }

    public function decrypt(?string $payload): ?string
    {
        if (!$payload) return null;

        $data = json_decode($payload, true);

        if (!isset($data['v'], $data['d'])) {
            return $this->decryptLegacy($payload);
        }

        $keyData = $this->keyService->getKeyByVersion($data['v']);
        $key = $this->generateKey($keyData->key);

        $decoded = base64_decode($data['d']);

        $iv   = substr($decoded, 0, 12);
        $tag  = substr($decoded, 12, 16);
        $text = substr($decoded, 28);

        return openssl_decrypt(
            $text,
            self::CIPHER,
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );
    }

    private function decryptLegacy(string $token): ?string
    {
        $oldKey = hash('sha256', 'super-secret-32-char-wbs-key', true);

        $replaced = strtr($token, '-_', '+/');
        $padding = strlen($replaced) % 4;
        
        if ($padding > 0) {
            $replaced .= str_repeat('=', 4 - $padding);
        }

        $data = base64_decode($replaced);

        $iv   = substr($data, 0, 12);
        $tag  = substr($data, 12, 16);
        $text = substr($data, 28);

        return openssl_decrypt(
            $text,
            self::CIPHER,
            $oldKey,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );
    }
}   