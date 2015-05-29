<?php

/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-5-24
 * Time: 下午9:27
 */
class UploadController extends ControllerBase
{
    public function indexAction()
    {
    }

    /**
     * 文件上传（单文件上传，多文件foreach）
     */
    public function doUploadAction()
    {
        header("Content-type: text/html; charset=utf-8");
//        var_dump($_FILES);
//        die;
        //确定文件类型
        $fileTypes = array(
            //常用图片格式
            'image/gif',  //gif
            'image/jpeg',  //jpg IE
            'image/pjpeg',  //jpg 火狐
            'image/png',  //png IE
            'image/x-png',  //png 火狐
            'image/pjpeg',  //jpg 火狐
            'image/pjpeg',  //jpg 火狐
            //常用文档格式
            'text/plain',  //txt
            'application/msword',  //doc
            'application/vnd.ms-excel',  //xls
            'application/vnd.ms-powerpoint',  //ppt
            'application/pdf',  //pdf
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  //docx
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',  //xlsx
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',  //pptx
            //常用压缩文档格式
            'application/octet-stream',  //rar
            'application/x-zip-compressed',  //zip
            'application/x-7z-compressed',  //7-Zip
        );
        //确定文件大小
        $fileMinSize = 0;
        $fileMaxSize = 1024 * 1024 * 2;
        //判断是否存在上传文件
        if (empty($_FILES['file']['tmp_name'])) {
            echo '上传文件为空';
            die;
        }
        //判断文件类型
        if (!in_array($_FILES["file"]["type"], $fileTypes)) {
            echo '文件类型不符';
            die;
        }
        //判断文件大小
        if ($_FILES["file"]["size"] < $fileMinSize || $_FILES["file"]["size"] > $fileMaxSize) {
            echo '文件大小不符';
            die;
        }
        //判断文件是否存在
        if (file_exists("files/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . ' 文件已经存在';
            die;
        }
        echo '文件名称：' . $_FILES["file"]["name"];
        echo '文件类型：' . $_FILES["file"]["type"];
        echo '文件大小：' . Tools::formatByte($_FILES["file"]["size"]);
        //保存文件
        move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $_FILES["file"]["name"]);
        echo "文件上传路径：" . "files/" . $_FILES["file"]["name"];
        die;

    }
}