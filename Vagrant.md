## Vagrant 安装

```
$ sudo apt-get install vagrant
```

最新版下载连接：[https://www.vagrantup.com/downloads.html](https://www.vagrantup.com/downloads.html)


## Vagrant 常用命令

查看
```
$ vagrant box list
```

删除
```
$ vagrant destroy
```

添加
```
$ vagrant box add --name ubuntu14.04  /home/zhanghe/ubuntu.box
```

修改配置
```
$ sudo subl Vagrantfile
```
```
    config.vm.box = "ubuntu14.04"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.synced_folder "/home/zhanghe/code", "/vagrant_code"
```

启动
```
$ vagrant up --provider=virtualbox
or
$ vagrant up
```

关闭
```
$ vagrant halt
```

登录
```
$ vagrant ssh
```
