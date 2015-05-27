<?php

class TestController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        echo 'Test';
        $aa = file_get_contents('/home/zhanghe/code/php/phalcon/app/library/rsa_1024_pub.pem');
        echo $aa.'<br/>';
        echo Tools::formatDate().'<br/>';
        echo Tools::realIp().'<br/>';
        //echo Tools::validateLogin().'<br/>';
        die;
    }

    /**
     * 加密解密
     */
    public function encryptAction()
    {
        $secretText = $this->crypt->encrypt('This is a test for Encryption!');
        $text = $this->crypt->decrypt($secretText, $this->crypt->getKey());

        $this->flash->success($secretText);
        $this->flash->success($text);
        die;
    }

    public function uploadAction()
    {}

    public function doUploadAction()
    {
        // Check if the user has uploaded files
        if ($this->request->hasFiles() == true) {

            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {

                //Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";

                //Move the file into the application
                $file->moveTo('files/' . $file->getName());
            }
        }
    }

    public function redisAction()
    {
        $redis = new Redis();
        $redis->connect( '127.0.0.1', $port = 6379);
        echo 'Server is running: '. $redis->ping();
        die;
    }
}

