<?php

use Phalcon\Mvc\Model;

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
        header("Content-type: text/html; charset=utf-8");
        $redis = $this->di->getShared('redis');
        echo 'Server is running: '. $redis->ping().'<br/>';
        echo $redis->keys('*').'<br/>';
        $uid = 2;
        $pid = 5;
        $num = 3;
        $pName = '产品'.$pid;
        $price = 128.00;

        $key = "cart:$uid:$pid";
        //初次加入物品
        $redis->hMSet($key,
            array(
                'pid' => $pid,
                'num' => $num,
                'pName' => $pName,
                'price' => $price,
            )
        );
        var_dump( $redis->hGetAll($key) );
        echo '<br/>';
        var_dump( $redis->hExists($key, 'pid') );
        echo '<br/>';
        //判断购物车中是否存在此商品
        if($redis->exists($key)){
            $redis->hIncrBy($key, 'num', $num);
        }
        var_dump( $redis->hGetAll($key) );
        echo '<br/>';
        $key = "cart:$uid:*";
        var_dump($redis->keys($key));
        die;
    }

    public function cartAction()
    {
        header("Content-type: text/html; charset=utf-8");
        $uid = 2;
        $pid = 4;
        $num = 4;
        $cart = new Cart($uid);
        var_dump($cart);
        $cart->Add($pid);
        $data = $cart->cartList();
        var_dump($data);
        echo "<br/>".'---------新增：';
        $cart->Increase($pid, 10);
        $data = $cart->cartList();
        var_dump($data);
        echo "<br/>".'---------减少：';
        $cart->Decrease($pid, 12);
        $data = $cart->cartList();
        var_dump($data);
        echo "<br/>".'---------重复添加：';
        $cart->Add($pid);
        $data = $cart->cartList();
        var_dump($data);

        die;
    }

    public function userAction()
    {
        $user = new User();

        //Store and check for errors
        //$success = $user->save($this->request->getPost(), array('name', 'email'));
        $user->name = '测试';
        $success = $user->save();

        if ($success) {
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }

    public function ajaxAction()
    {
        if($this->request->isAjax()){
            echo '这是一个ajax请求';
            $this->view->disable();
        }
        if($this->request->isPost()){
            //暂停 3 秒
            //sleep(3);
            echo '这是一个post请求';
            $this->view->disable();
        }
    }

    public function testCountAction()
    {
        // http://phalcon/test/testCount
        // 测试记录为空的情况
        $order_list_find = Orderlist::find(array('id > 0', 'limit' => 100));
        $order_list_find_first = Orderlist::findFirst('id = 1');
        // bool(false) int(0) bool(false) int(0) bool(false) string(1) "0"
        var_dump(!$order_list_find);  // 错误用法 bool(false)
        var_dump(count($order_list_find));  // 正确用法 int(0)
        var_dump(empty($order_list_find));  // 错误用法 bool(false)
        var_dump($order_list_find->count());  // int(0)
        var_dump($order_list_find_first);  // 无结果返回 bool(false)
        var_dump(Orderlist::count());  // string(1) "0"

        echo "<p/>";

        // 测试记录不为空的情况
        $user_find = User::find(array('id > 0', 'limit' => 100));
        $user_find_first = User::findFirst('id = 1');

        var_dump(!$user_find);  // 错误用法 bool(false)
        var_dump(count($user_find));  // 正确用法 int(29)
        var_dump($user_find->count());  // int(29)
         var_dump(!$user_find_first);  // bool(false) $user_find_first有结果返回 对象
        var_dump($user_find_first->count());  // string(2) "29"
        var_dump(User::count());  // string(2) "29"

        // 总结
        // Find 记录判断用法
        if (!count($result_find)) {
            // 如果没有记录...
        }else{
            // ...
        }

        // FindFirst 记录判断用法
        if (!$result_find_first) {
            // 如果没有记录...
        }else{
            // ...
        }
    }
}

