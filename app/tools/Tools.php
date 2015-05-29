<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-5-24
 * Time: 下午10:02
 */


/**
 * 自定义工具类
 * Class Tools
 */
class Tools
{
    /**
     * 格式化显示文件大小
     * @param $size
     * @param int $dec
     * @return string
     */
    public static function formatByte($size, $dec = 2)
    {
        $array = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        return round($size, $dec) . " " . $array[$pos];
    }

    /**
     * 格式化时间
     * @param $time '时间戳'
     * @return bool|string
     */
    public static function formatDate($time)
    {
        $date = is_null($time) ? date('Y-m-d H:i:s', time()) : date('Y-m-d H:i:s', $time);
        return $date;
    }

    /**
     * 计算时间差
     * 使用方法：
     * $time_diff = Tools::timeDiff('2014-06-07', '2015-06-09');
     * var_dump($time_diff);
     * @param $start
     * @param $end
     * @param string $type
     * @return float
     */
    public static function timeDiff($start, $end, $type = 'day')
    {
        switch ($type) {
            case 'second':
                $second = 1;
                break;
            case 'minute':
                $second = 60;
                break;
            case 'hour':
                $second = 60 * 60;
                break;
            default:
                $second = 60 * 60 * 24;
        }
        $time = floor((strtotime($end) - strtotime($start)) / $second);
        return $time;
    }

    /**
     * 获得真实IP地址
     * @return string
     */
    public static function realIp()
    {
        static $realIp = NULL;
        if ($realIp !== NULL) return $realIp;
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realIp = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realIp = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realIp = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realIp = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realIp = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realIp = getenv('HTTP_CLIENT_IP');
            } else {
                $realIp = getenv('REMOTE_ADDR');
            }
        }
        preg_match('/[\d\.]{7,15}/', $realIp, $onlineIp);
        $realIp = !empty($onlineIp[0]) ? $onlineIp[0] : '0.0.0.0';
        return $realIp;
    }

    /**
     * 创建目录
     * @param string $dir
     */
    public static function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
    }

    /**
     * 创建文件
     * @param $filename
     */
    public static function createFile($filename)
    {
        if (!is_file($filename)) {
            touch($filename);
        }
    }

    /**
     * 删除空目录
     * @param $dir
     */
    public static function delEmptyDir($dir)
    {
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }

    /**
     * 删除非空目录
     * @param $dir
     * @return bool
     */
    public static function delDir($dir)
    {
        //先删除目录下的文件：
        if (is_dir($dir)) {
            $dh = opendir($dir);
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $fullPath = $dir . "/" . $file;
                    if (!is_dir($fullPath)) {
                        unlink($fullPath);
                    } else {
                        self::delDir($fullPath);
                    }
                }
            }
            closedir($dh);
            //再删除当前空目录：
            if (rmdir($dir)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 验证登陆
     */
    public static function validateLogin()
    {
        if (empty($_SESSION['admin']['user'])) {
            header('Location:/index/');
        }
    }

    /**
     * 分页处理
     * @param int $count 记录总数
     * @param int $pageNumber 单页显示数量
     * @param int $currentPage 当前页码
     * @param string $type 返回参数类型
     * @return array|paginationResult
     */
    public static function pagination($count, $pageNumber, $currentPage, $type='object')
    {
        //处理最小页数
        $currentPage = $currentPage <= 0 ? 1 : $currentPage;
        //处理最大页数
        $maxPage = ceil($count / $pageNumber);
        $currentPage = $currentPage > $maxPage ? $maxPage : $currentPage;
        //分页偏移量
        $offset = ($currentPage - 1) * $pageNumber;
        //上一页下一页
        $prePage = ($currentPage - 1) <= 0 ? 1 : ($currentPage - 1);
        $nextPage = ($currentPage + 1) > $maxPage ? $maxPage : ($currentPage + 1);
        //返回数组格式
        if($type == 'array') {
            return array(
                'offset' => $offset,
                'prePage' => $prePage,
                'nextPage' => $nextPage,
                'maxPage' => $maxPage
            );
        }
        //默认返回对象格式
        $result = new paginationResult();
        $result->offset = $offset;
        $result->prePage = $prePage;
        $result->nextPage = $nextPage;
        $result->maxPage = $maxPage;
        return $result;
    }
}

/**
 * 定义分页处理返回结果对象结构
 * Class paginationResult
 */
class paginationResult
{
    public $offset;  //偏移量
    public $prePage;  //上一页页码
    public $nextPage;  //下一页页码
    public $maxPage;  //最大页数
}