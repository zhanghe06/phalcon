<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 2017/3/3
 * Time: 上午12:22
 */


require(dirname(__FILE__) . '/../library/ChuangLanSmsIsoApi.php');

/* ========== 国际短信 ========== */
$sms = new ChuangLanSmsIsoApi('账号', '密码');

// 发送手机号（国家区号+手机号码）
$result = $sms->sendInternational('0086手机号码', 'Your validation code is 343456');
var_dump($result);

// 查询余额
$result = $sms->queryBalanceInternational();
var_dump($result);
