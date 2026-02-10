<?php

namespace App\Helpers;

class AesHelper
{
    private const CIPHER = 'aes-256-gcm';

    private static function key(): string
    {
        return hash('sha256', config('app.key'), true);
    }

    public static function encrypt(string $plainText): string
    {
        $iv = random_bytes(12);
        $key = self::key();

        $cipherText = openssl_encrypt(
            $plainText,
            self::CIPHER,
            $key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        return rtrim(strtr(base64_encode(
            $iv . $tag . $cipherText
        ), '+/', '-_'), '=');
    }

    public static function decrypt(string $token): string
    {
        $data = base64_decode(strtr($token, '-_', '+/'));

        $iv   = substr($data, 0, 12);
        $tag  = substr($data, 12, 16);
        $text = substr($data, 28);

        return openssl_decrypt(
            $text,
            self::CIPHER,
            self::key(),
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );
    }
}