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

3.0最新稳定版安装记录
```
$ wget http://download.redis.io/releases/redis-3.0.5.tar.gz
$ tar xzf redis-3.0.5.tar.gz
$ cd redis-3.0.5
$ make
```

启动服务
```
$ src/redis-server
```

开启客户端
```
$ src/redis-cli
```

配置软链
```
$ sudo ln -s /home/zhanghe/redis-3.0.5/src/redis-server /usr/bin/redis-server
$ sudo ln -s /home/zhanghe/redis-3.0.5/src/redis-cli /usr/bin/redis-cli
```

设置开机启动
```
$ echo "/usr/bin/redis-server /home/zhanghe/redis-3.0.5/redis.conf > /dev/null &" >> /etc/rc.local
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

重启php服务
```
$ sudo service php5-fpm restart
```