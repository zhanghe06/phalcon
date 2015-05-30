<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-5-29
 * Time: 下午11:56
 */

/**
 * 基于Redis的购物车
 * Class Cart
 */
class Cart extends \Phalcon\Di\Injectable
{
    private $Prefix;
    private $uid;

    /**
     * 初始化购物车
     * @param $uid
     * @param string $Prefix
     */
    public function __construct($uid, $Prefix='cart')
    {
        $this->uid = $uid;
        $this->Prefix = $Prefix;
    }

    /**
     * 添加物品
     * @param $pid
     * @param int $num
     * @return bool
     */
    public function Add($pid, $num = 1)
    {
        $redis = $this->di->getShared('redis');
        $key = "$this->Prefix:$this->uid:$pid";
        //判断物品是否存在
        if ($redis->exists($key)) {
            //如果存在，仅增加相应数量
            $redis->hIncrBy($key, 'num', $num);
        } else {
            //如果不存在，添加物品至购物车
            $redis->hMSet($key,
                array(
                    'pid' => $pid,
                    'num' => $num,
                )
            );
        }
        return true;
    }

    /**
     * 删除物品
     * @param $pid
     * @return bool
     */
    public function Del($pid)
    {
        $redis = $this->di->getShared('redis');
        $key = "$this->Prefix:$this->uid:$pid";
        //判断物品是否存在
        if ($redis->exists($key)) {
            $redis->del($key);
        }
        return true;
    }

    /**
     * 增加物品数量
     * @param $pid
     * @param int $num
     * @return bool
     */
    public function Increase($pid, $num = 1)
    {
        $redis = $this->di->getShared('redis');
        $key = "$this->Prefix:$this->uid:$pid";
        //判断购物车中是否存在此商品
        if ($redis->exists($key)) {
            $redis->hIncrBy($key, 'num', $num);
        }
        return true;
    }

    /**
     * 减少物品数量
     * @param $pid
     * @param int $num
     * @return bool
     */
    public function Decrease($pid, $num = 1)
    {
        $redis = $this->di->getShared('redis');
        $key = "$this->Prefix:$this->uid:$pid";
        //判断购物车中是否存在此商品
        if ($redis->exists($key)) {
            //判断扣减的数量是否超过购物车的数量
            if ($num >= $redis->hGet($key, 'num')) {
                //如果超过，设置默认最小数量
                $redis->hMSet($key, array('num' => '1',));
            }
            $redis->hIncrBy($key, 'num', -$num);
        }
        return true;
    }

    /**
     * 显示购物车
     * @return array
     */
    public function cartList()
    {
        $redis = $this->di->getShared('redis');
        $key = "$this->Prefix:$this->uid:*";
        $cartKeyList = $redis->keys($key);
        $cart = array();
        foreach($cartKeyList as $item){
            $cart[] = $redis->hGetAll($item);
        }
        return $cart;
    }
}