## git官网

<http://git-scm.com/>

##git教程

<http://git-scm.com/book/zh/v1/>

##git安装

方式一：
软件包管理系统安装
```
$ sudo apt-get install git
```

方式二：
源码安装（这种方式可以体验最新版的功能）
先安装依赖
```
$ sudo apt-get install libcurl4-openssl-dev libexpat1-dev
```
下载源码
<https://github.com/git/git>

进入源码所在的目录进行编译
```
$ make prefix=/usr/local all
$ sudo make prefix=/usr/local install
```

##git基本使用

详见教程，这里省略……

##git本地版本回退
```
$ git log
查看提交信息，包含每次commit的SHA1值
```
```
$ git reset --mixed
此为默认方式，不带任何参数的git reset，即是这种方式。
它回退到某个版本，只保留源码，回退commit和index信息
```
```
$ git reset --soft a2348a50c801bc3b2ecdb3a463b1f24da1d8cd47
回退到某个版本，只回退了commit的信息，不会恢复到index file一级。如果还要提交，直接commit即可
```
```
$ git reset --hard a2348a50c801bc3b2ecdb3a463b1f24da1d8cd47
彻底回退到某个版本，本地的源码也会变为上一个版本的内容
```
```
HEAD 最近一个提交
HEAD^ 上一次
```

##git乱码的解决办法
```
$ git config --global core.quotepath false
```

##git配置别名
```
$ git config --global alias.st status
$ git config --global alias.co checkout
$ git config --global alias.ci commit
$ git config --global alias.br branch
```
甚至还有人丧心病狂地把lg配置成了:
```
$ git config --global alias.lg "log --color --graph --pretty=format:'%Cred%h%Creset -%C(yellow)%d%Creset %s %Cgreen(%cr) %C(bold blue)<%an>%Creset' --abbrev-commit"
```
配置Git的时候，加上--global是针对当前用户起作用的，如果不加，那只针对当前的仓库起作用。

每个仓库的Git配置文件都放在.git/config文件中
而当前用户的Git配置文件放在用户主目录下的一个隐藏文件.gitconfig中
别名就在[alias]后面，要删除别名，直接把对应的行删掉即可