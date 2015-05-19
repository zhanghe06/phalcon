##ubuntu14.04环境使用Tomcat7部署Solr5

检测java环境
```
$ ls /usr/lib/jvm
default-java  java-1.7.0-openjdk-i386  java-7-openjdk-i386
```

安装tomcat
```
$ apt-cache search tomcat
$ sudo apt-get install tomcat7
```

检测是否成功

浏览器访问
<http://127.0.0.1:8080/>

打开的页面中有关于路径的配置
```
Tomcat 配置文件路径
Tomcat home directory : /usr/share/tomcat7
Tomcat base directory : /var/lib/tomcat7或/etc/tomcat7
/var/lib/tomcat7/webapps/ROOT/index.html
```

关于服务的操作：

启动服务
```
$ sudo /etc/init.d/tomcat7 start 或 sudo service tomcat7 start
```

关闭服务
```
$ sudo /etc/init.d/tomcat7 stop 或 sudo service tomcat7 stop
```

重启服务
```
$ sudo /etc/init.d/tomcat7 restart 或 sudo service tomcat7 restart
```

设置Tomcat管理员帐号

Tomcat的用户帐号信息都保存在tomcat-users.xml的文件中，运行
```
$ sudo subl /var/lib/tomcat7/conf/tomcat-users.xml
```

在<tomcat-users>...</tomcat-users>的标签之间添加一行
```
<user username="用户名" password="密码" roles="admin,manager"/>
```

保存并关闭。重新运行tomcat即可输入该用户名和密码，登录Tomcat的管理页面。

将solr目录下的webapps/solr.war复制到tomcat的webapps目录中，并重启服务
```
$ sudo cp /home/zhanghe/solr-5.1.0/server/webapps/solr.war /var/lib/tomcat7/webapps/
$ sudo service tomcat7 restart
```
这时候/var/lib/tomcat7/webapps目录下会多一个solr子目录


配置web.xml
```
$ cd /var/lib/tomcat7/webapps/solr/WEB-INF
$ sudo subl web.xml
```

```
  <!--
    <env-entry>
       <env-entry-name>solr/home</env-entry-name>
       <env-entry-value>/put/your/solr/home/here</env-entry-value>
       <env-entry-type>java.lang.String</env-entry-type>
    </env-entry>
   -->
  <env-entry>
       <env-entry-name>solr/home</env-entry-name>
       <env-entry-value>/home/zhanghe/solr_home</env-entry-value>
       <env-entry-type>java.lang.String</env-entry-type>
  </env-entry>
```

创建SOLR_HOME根目录
```
$ cd /home/zhanghe/
$ mkdir solr_home
```

复制solr-5.1.0/server/solr/所有文件到solr_home目录下
```
$ sudo cp -r /home/zhanghe/solr-5.1.0/server/solr/* /home/zhanghe/solr_home/
```

复制jar包和配置文件到tomcat相应目录中
```
$ sudo cp -r /home/zhanghe/solr-5.1.0/server/lib/ext/* /usr/share/tomcat7/lib/
$ sudo cp -r  /home/zhanghe/solr-5.1.0/server/resources/log4j.properties /var/lib/tomcat7/webapps/solr/WEB-INF/
重启tomcat服务
$ sudo service tomcat7 restart
```

浏览器中输入<http://127.0.0.1:8080/solr>
成功！