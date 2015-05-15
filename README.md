##Phalcon扩展的配置

参考文档：
<http://docs.phalconphp.com/zh/latest/index.html>

安装
$ git clone --depth=1 git://github.com/phalcon/cphalcon.git
$ cd cphalcon/build
$ sudo ./install

成功后大致如下信息：
```
    /bin/bash /home/zhanghe/cphalcon/build/32bits/libtool --mode=install cp ./phalcon.la /home/zhanghe/cphalcon/build/32bits/modules
    libtool: install: cp ./.libs/phalcon.so /home/zhanghe/cphalcon/build/32bits/modules/phalcon.so
    libtool: install: cp ./.libs/phalcon.lai /home/zhanghe/cphalcon/build/32bits/modules/phalcon.la
    libtool: finish: PATH="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/sbin" ldconfig -n /home/zhanghe/cphalcon/build/32bits/modules
    ----------------------------------------------------------------------
    Libraries have been installed in:
       /home/zhanghe/cphalcon/build/32bits/modules

    If you ever happen to want to link against installed libraries
    in a given directory, LIBDIR, you must either use libtool, and
    specify the full pathname of the library, or use the `-LLIBDIR'
    flag during linking and do at least one of the following:
       - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
         during execution
       - add LIBDIR to the `LD_RUN_PATH' environment variable
         during linking
       - use the `-Wl,-rpath -Wl,LIBDIR' linker flag
       - have your system administrator add LIBDIR to `/etc/ld.so.conf'

    See any operating system documentation about shared libraries for
    more information, such as the ld(1) and ld.so(8) manual pages.
    ----------------------------------------------------------------------

    Build complete.
    Don't forget to run 'make test'.

    Installing shared extensions:     /usr/lib/php5/20121212+lfs/
    Installing header files:          /usr/include/php5/

    Thanks for compiling Phalcon!
    Build succeed: Please restart your web server to complete the installation
```


$ ln -s /home/zhanghe/cphalcon/build/32bits/modules/phalcon.so /usr/local/lib/phalcon.so

$ sudo vim /etc/php5/fpm/conf.d/phalcon.ini

extension=phalcon.so

$ sudo service php5-fpm restart


##Phalcon开发工具的安装

下载地址：
<https://github.com/phalcon/phalcon-devtools>

参考文档：
<http://docs.phalconphp.com/zh/latest/reference/tools.html>

使用
$ ~/phalcon-devtools-master/phalcon.php commands
```
Phalcon DevTools (2.0.0)

Available commands:
  commands (alias of: list, enumerate)
  controller (alias of: create-controller)
  model (alias of: create-model)
  all-models (alias of: create-all-models)
  project (alias of: create-project)
  scaffold (alias of: create-scaffold)
  migration (alias of: create-migration)
  webtools (alias of: create-webtools)
```

$ sudo ln -s ~/phalcon-devtools-master/phalcon.php /usr/bin/phalcon
$ chmod ugo+x /usr/bin/phalcon

测试
$ phalcon commands
```
Phalcon DevTools (2.0.0)

Available commands:
  commands (alias of: list, enumerate)
  controller (alias of: create-controller)
  model (alias of: create-model)
  all-models (alias of: create-all-models)
  project (alias of: create-project)
  scaffold (alias of: create-scaffold)
  migration (alias of: create-migration)
  webtools (alias of: create-webtools)
```

配置PhpStorm的Phalcon代码提示扩展

External Libraries >> Configure PHP Include Paths...
点击Include Path 右侧的加号（+）
输入：
/home/zhanghe/phalcon-devtools-master/ide/2.0.0
应用，保存


## Phalcon开发工具创建应用

$ phalcon project phalcon --type=simple --enable-webtools

配置数据库参数
/home/zhanghe/code/php/phalcon/app/config/config.php
```
'database' => array(
    'adapter'     => 'Mysql',
    'host'        => 'localhost',
    'username'    => 'root',
    'password'    => '123456',
    'dbname'      => 'phalcon',
    'charset'     => 'utf8',
)
```

修改配置文件
/home/zhanghe/code/php/phalcon/app/config/config.php
```
'baseUri'        => '/phalcon/'
修改为：
'baseUri'        => '/'
```

BUG修复
/home/zhanghe/code/php/phalcon/app/config/services.php
```
$di->set('db', function () use ($config) {
    return new DbAdapter($config->toArray());
});
修改为：
$di->set('db', function () use ($config) {
    return new DbAdapter($config->database->toArray());
});
```

进入项目目录
$ cd phalcon

为cache目录增加权限
$ cd app
$ chmod 777 -R cache/

创建nginx配置文件

参考<http://docs.phalconphp.com/zh/latest/reference/nginx.html>

$ touch ~/my_php_code/my_php_code.conf
$ subl ~/my_php_code/my_php_code.conf


```
server {
	listen   80;
	server_name phalcon;
    
    try_files $uri $uri/ @rewrite;

    location @rewrite {
        rewrite ^/(.*)$ /index.php?_url=/$1;
    }
    location / {
        root   /home/zhanghe/code/php/phalcon/public;
        index  index.html index.htm index.php;
    }

    location ~ \.php$ {
        root           /home/zhanghe/code/php/phalcon/public;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  /home/zhanghe/code/php/phalcon/public/$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```

$ sudo ln -s ~/code/php/phalcon/phalcon.conf /etc/nginx/sites-enabled/phalcon.conf
$ sudo nginx -s reload

配置host文件
$ sudo subl /etc/hosts
添加(注意，域名不能有下划线)
```
127.0.0.1 phalcon
```


创建控制器
$ cd ~/code/php/phalcon
$ phalcon controller test

创建模型
$ phalcon model user


