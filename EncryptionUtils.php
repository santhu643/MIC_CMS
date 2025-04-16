<?php
class EncryptionUtils {
    private static $encryption_key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU='; // Change this to a secure key
    private static $cipher = 'AES-256-CBC';

    public static function encrypt($data) {
        $encryption_key = base64_decode(self::$encryption_key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$cipher));
        $encrypted = openssl_encrypt($data, self::$cipher, $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    public static function decrypt($data) {
        $encryption_key = base64_decode(self::$encryption_key);
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, self::$cipher, $encryption_key, 0, $iv);
    }
}
?>