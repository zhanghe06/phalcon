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
    public static function byte_format($size, $dec = 2)
    {
        $array = array("B", "KB", "MB", "GB", "TB", "PB");
        $pos = 0;
        while ($size >= 1024) {
            $size /= 1024;
            $pos++;
        }
        return round($size, $dec) . " " . $array[$pos];
    }
}