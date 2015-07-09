##Jquery

最初加载 jquery-1.10.2.min.js
出现 jquery-1.10.2.min.map 404 的情况

解决办法：
下载 [jquery-1.10.2.min.map](https://code.jquery.com/jquery-1.10.2.min.map "jquery-1.10.2.min.map") 文件
与 [jquery-1.10.2.min.js](https://code.jquery.com/jquery-1.10.2.min.js "jquery-1.10.2.min.js") 放在同级目录

给map文件设置权限

```
$ chmod 664 jquery-1.10.2.min.map
```

否则会继续出现403的情况

```
zhanghe@ubuntu:~/code/php/phalcon/public/js/jquery$ ls -lh
总用量 232K
-rw-rw-r-- 1 zhanghe zhanghe    0  5月 15 23:40 index.html
-rw-rw-r-- 1 zhanghe zhanghe  91K  7月  9 22:44 jquery-1.10.2.min.js
-rw-r----- 1 zhanghe zhanghe 137K  7月  9 22:28 jquery-1.10.2.min.map
zhanghe@ubuntu:~/code/php/phalcon/public/js/jquery$ chmod 664 jquery-1.10.2.min.map
zhanghe@ubuntu:~/code/php/phalcon/public/js/jquery$ ls -lh
总用量 232K
-rw-rw-r-- 1 zhanghe zhanghe    0  5月 15 23:40 index.html
-rw-rw-r-- 1 zhanghe zhanghe  91K  7月  9 22:44 jquery-1.10.2.min.js
-rw-rw-r-- 1 zhanghe zhanghe 137K  7月  9 22:28 jquery-1.10.2.min.map
```
