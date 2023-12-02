<?php
/**
 * @desc 国密 SM4 加解密
 * @author Tinywan(ShaoBo Wan)
 * @email 756684177@qq.com
 * @date 2023/11/4 21:05
 */

declare(strict_types=1);

namespace security;

class SM4Util
{
    // 加密算法
    private const ALGORITHM = 'SM4-CBC';

    /**
     * @desc 加密
     * @param string $encryptText
     * @param string $key 32位秘钥key
     * @param string $iv 法密码iv长度
     * @return string
     * @author Tinywan(ShaoBo Wan)
     */
    public static function encrypt(string $encryptText, string $key, string $iv): string
    {
        return openssl_encrypt($encryptText, self::ALGORITHM, hex2bin($key), OPENSSL_CIPHER_RC2_40, $iv);
    }

    /**
     * @desc 解密
     * @param string $decryptText
     * @param string $key 32位秘钥key
     * @param string $iv 法密码iv长度
     * @return string
     * @author Tinywan(ShaoBo Wan)
     */
    public static function decrypt(string $decryptText, string $key, string $iv): string
    {
        return openssl_decrypt($decryptText, self::ALGORITHM, hex2bin($key), OPENSSL_CIPHER_RC2_40, $iv);
    }

    /**
     * @desc 获取iv值
     * @author Tinywan(ShaoBo Wan)
     */
    public static function main()
    {
        // 32位key
        $key = '4d7f2e7fe8e450385253bf379b13e432';

        // 获取对应算法密码iv长度
        $ivLength = openssl_cipher_iv_length(self::ALGORITHM);
        $iv = (string)rand(pow(10, ($ivLength - 1)), pow(10, $ivLength) - 1);

        // 加密字符串
        $plaintext = '开源技术小栈';
        $ciphertext = self::encrypt($plaintext, $key, $iv);
        printf("加密结果1: %s\n", $ciphertext);
        printf("解密结果2: %s\n", self::decrypt($ciphertext, $key, $iv));

    }
}