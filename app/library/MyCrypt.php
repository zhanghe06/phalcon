<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-5-22
 * Time: 上午12:16
 */

/**
 * 自定义非对称加密解密类
 * Class MyCrypt
 */
class MyCrypt
{
    private $pub_key = '';
    private $pri_key = '';

    /**
     * 初始化，设置公钥、私钥
     */
    public function __construct()
    {
        $this->pub_key = file_get_contents(__DIR__.'/rsa_1024_pub.pem');
        $this->pri_key = file_get_contents(__DIR__.'/rsa_1024_pri.pem');
    }

    /**
     * 获取公钥
     * @return string
     */
    public function getPubKey()
    {
        return $this->pub_key;
    }

    /**
     * 获取私钥
     * @return string
     */
    public function getPriKey()
    {
        return $this->pri_key;
    }

    /**
     * 设置公钥
     * @param $pub_key
     */
    public function setPubKey($pub_key)
    {
        $this->pub_key = $pub_key;
    }

    /**
     * 设置私钥
     * @param $pri_key
     */
    public function setPriKey($pri_key)
    {
        $this->pri_key = $pri_key;
    }

    /**
     * 加密
     * @param $data
     * @return string
     * @throws Exception
     */
    public function encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, $this->pub_key)) {
            $data_encrypted = base64_encode($encrypted);
        } else {
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');
        }
        return $data_encrypted;
    }

    /**
     * 解密
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, $this->pri_key)) {
            $data_decrypted = $decrypted;
        } else {
            $data_decrypted = '';
        }
        return $data_decrypted;
    }
}