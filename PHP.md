## 安装php
```
$ sudo apt-get install php5-fpm
$ sudo apt-get install php5-cli       # Makes the php5 command available to the terminal for php5 scripting
$ sudo apt-get install php5-curl      # Allows curl (file downloading tool) to be called from PHP5
$ sudo apt-get install php5-gd        # Popular image manipulation library; used extensively by Wordpress and it's plugins.
$ sudo apt-get install php5-mcrypt    # Provides encryption algorithms to PHP scripts
$ sudo apt-get install php5-mysql     # Allows PHP5 scripts to talk to a MySQL Database
```

Ubuntu 14.04 默认是　PHP 5.5.9
```
$ php -v
PHP 5.5.9-1ubuntu4.19 (cli) (built: Jul 28 2016 19:31:33)
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
    with Zend OPcache v7.0.3, Copyright (c) 1999-2014, by Zend Technologies
```

如果需要指定版本
```
$ sudo apt-get install python-software-properties  # 管理软件仓库的程序
$ sudo add-apt-repository ppa:ondrej/php5-5.6
$ sudo apt-get update
```

PHP information and configuration
```
$ php -i
```

Show compiled in modules
```
$ php -m
```

Run PHP interactively
```
$ php -a
```

查看生效的 php.ini
```
php -i | grep ini
```

