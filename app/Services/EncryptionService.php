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

        $rawKey = $this->keyService->getKey();
        $key = $this->generateKey($rawKey);

        $iv = random_bytes(12);

        $cipherText = openssl_encrypt(
            $plainText,
            self::CIPHER,
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        return base64_encode($iv . $tag . $cipherText);
    }

    public function decrypt(?string $payload): ?string
    {
        if (!$payload) return null;

        $rawKey = $this->keyService->getKey();
        $key = $this->generateKey($rawKey);

        $data = base64_decode($payload);

        $iv   = substr($data, 0, 12);
        $tag  = substr($data, 12, 16);
        $text = substr($data, 28);

        return openssl_decrypt(
            $text,
            self::CIPHER,
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );
    }
}