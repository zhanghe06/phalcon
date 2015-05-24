<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-5-21
 * Time: 下午10:32
 */

class LoginController extends ControllerBase
{
    public function indexAction()
    {}

    public function doLoginAction()
    {
        $rsa = new MyCrypt();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        var_dump($email, $password, $rsa->decrypt($email), $rsa->decrypt($password));
        die;
    }
}