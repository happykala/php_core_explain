#!/bin/bash

# 最高指导地址http://httpd.apache.org/docs/2.4/install.html，然后碰到错误就去查吧。
# 下面的安装是在ubuntu14.04环境下安装的，更高操作系统版本的仅作为参考，估计过程是大同小异的

# 更新软件包
sudo apt-get update;

# 安装依赖包
apt-get install --yes \
  wget \
  make \
  gcc \
  g++ \
  openssl \
  unzip \
  cmake \
  libncurses5-dev \
  libjpeg-dev \
  libpng12-dev \
  libxml2 \
  libxml2-dev \
  curl \
  libtool \
  libevent-dev \
  autoconf \
  perl \
  libexpat1-dev \
  vim;

# 创建安装文件夹
mkdir --parents /usr/local/apr;
mkdir --parents /usr/local/apr-util;
mkdir --parents /usr/local/pcre;
# 安装apr
wget http://mirrors.tuna.tsinghua.edu.cn/apache//apr/apr-1.6.5.tar.gz;
tar xf apr-1.6.5.tar.gz; 
cd apr-1.6.5;
./configure --prefix=/usr/local/apr/;
make && make install && make clean;

# 安装apr-util
wget http://mirrors.tuna.tsinghua.edu.cn/apache//apr/apr-util-1.6.1.tar.gz;
tar -zxvf apr-util-1.6.1.tar.gz;
cd apr-util-1.6.1;
./configure --prefix=/usr/local/apr-util --with-apr=/usr/local/apr;
make && make install && make clean;

# 安装pcre
wget https://ftp.pcre.org/pub/pcre/pcre-8.42.tar.gz;
tar -zxvf pcre-8.42.tar.gz;
cd pcre-8.42;
./configure --prefix=/usr/local/pcre;
make && make install && make clean;

# 编译安装apache
#创建运行apache的用户
groupadd www;
useradd -g www www -s /bin/false;

#下载软件
wget http://mirrors.tuna.tsinghua.edu.cn/apache//httpd/httpd-2.4.35.tar.gz;
tar -zxvf httpd-2.4.35.tar.gz;
cd httpd-2.4.35;

# 最新版的处理在编译之前要在服务器安装目录下把apr和apr-util移动到指定的目录下
cd /usr/local;
mkdir httpd;
cd httpd;
mkdir srclib;
cd /usr/local;
cp -r apr  /usr/local/httpd/srclib/apr;
cp -r apr-util  /usr/local/httpd/srclib/apr-util;

#编译
./configure --prefix=/usr/local/httpd/ \
--sysconfdir=/etc/httpd/ \
--with-include-apr \
--disable-userdir \
--enable-headers \
--with-mpm=worker \
--enable-modules=most \
--enable-so \
--enable-deflate \
--enable-defate=shared \
--enable-expires-shared \
--enable-rewrite=shared \
--enable-static-support \
--with-apr=/usr/local/apr/ \
--with-apr-util=/usr/local/apr-util/bin \
--with-pcre=/usr/local/pcre/ \
--with-ssl \
--with-z;

# 安装
make && make install && make clean;

#修改配置文件（/etc/httpd/httpd.conf）
#将ServerName www.example.com:80 改 ServerName locahost:80
#修改用户和用户组把user=deamon group=deamon 改成 user=www group=www

# 增加apache的环境变量
# vim /etc/profile
# export PATH=$PATH:/usr/local/httpd/bin/
# source /etc/profile

#配置apache为开机自启动
# cp /usr/local/httpd/bin/apachectl /etc/init.d/httpd
# 修改你的vim /etc/init.d/httpd脚本 在开始处#!/bin/bash之后的行后插入
# # chkconfig: 345 61 61
# # description:Apache httpd
# # 增加服务
# chkconfig --add httpd
# chkconfig --level 2345 httpd on

#apache的启动 重启和停止
#启动|停止|重启   /etc/init.d/httpd start|stop|restart
#扩展操作
#启动          /usr/local/httpd/bin/apachectl -f /etc/httpd/httpd.conf
#暴力停止      /usr/local/httpd/bin/apachectl -k stop
#优雅停止      /usr/local/httpd/bin/apachectl -k graceful-stop
#优雅的重启   /usr/local/httpd/bin/apachectl -k graceful
#暴力重启     /usr/local/httpd/bin/apachectl -k restart