##redis下载

<http://redis.io/download>

选择版本下载，加压至home目录

安装过程比较简单
```
$ cd ~/redis-2.4.6
$ ./configure && make && make install
```

启动服务
```
$ redis-server /home/zhanghe/redis-2.4.6/redis.conf > /dev/null &
```

开机加自启动：
```
$ echo "redis-server /home/zhanghe/redis-2.4.6/redis.conf > /dev/null &" >>/etc/rc.local
```

打开本地客户端
```
$ redis-cli
```

连接远程服务
```
$ redis-cli -h 192.168.2.184
```

##phpRedis扩展

<https://github.com/owlient/phpredis>已停止维护

<https://github.com/phpredis/phpredis>

下载解压至home目录
```
$ cd ~/phpredis-develop
$ phpize
$ ./configure –with-php-config=/usr/bin/php-config
$ make
$ sudo make install
```

安装完成之后，提示：
```
Installing shared extensions:     /usr/lib/php5/20121212+lfs/
```

配置扩展
```
$ sudo subl /etc/php5/fpm/conf.d/redis.ini
extension=redis.so
```