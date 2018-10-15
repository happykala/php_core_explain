#!/bin/bash

# 下载PHP的源码并解压 源码下载的地址http://php.net/downloads.php，下载完成之后上传到目录下
tar -zxvf php-7.2.11.tar.gz


# 安装必要的依赖，依赖根据配置过程中出现的错误做适当的修改
# 这个对应解决的错误是configure: error: cURL version 7.10.5 or later is required to compile php with cURL support
sudo wget https://curl.haxx.se/download/curl-7.20.0.tar.gz;
sudo tar -xzvf curl-7.20.0.tar.gz;
cd curl-7.20.0;
./configure;
make && make install && make clean;
# 出现这个错误configure: error: Cannot find OpenSSL's <evp.h>，但是openssl已经安装了，在ubuntu下还要安装这个库libssl-dev
apt-get install libssl-dev;
# 错误configure: error: freetype-config not found.
apt-get install libfreetype6-dev;


# 配置
cd php-7.2.11;
./configure --prefix=/usr/local/php \
    --with-config-file-path=/usr/local/php/etc \
    --with-apxs2=/usr/local/httpd/bin/apxs \
    --enable-fpm \
    --with-fpm-user=www \
    --with-fpm-group=www \
    --with-mysqli \
    --with-pdo-mysql \
    --with-iconv-dir \
    --with-freetype-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib \
    --with-libxml-dir=/usr \
    --enable-xml \
    --disable-rpath \
    --enable-bcmath \
    --enable-shmop \
    --enable-sysvsem \
    --enable-inline-optimization \
    --with-curl \
    --enable-mbregex \
    --enable-mbstring \
    --enable-ftp \
    --with-gd \
    --with-openssl-dir \
    --with-mhash \
    --enable-pcntl \
    --enable-sockets \
    --with-xmlrpc \
    --enable-zip \
    --enable-soap \
    --without-pear \
    --with-gettext \
    --disable-fileinfo \
    --enable-maintainer-zts;

# 配置完成之后编译安装
make && make install && make clean;
# 还可以测试
make test;

# 将源码中的配置文件拷贝到配置的安装目录中
cp php.ini-development /usr/local/php/etc/php.ini; 

# 使用apache模块的方式运行php的时候，要检查apache的模块是都加载了没有的情况下要在apache服务器配置文件加入如下的代码
# LoadModule php7_module modules/libphp7.so
# 同时对下面的标签做修改
# <IfModule dir_module>
#    DirectoryIndex index.html index.php index.htm
# </IfModule>
# <IfModule mime_module>
#     AddType application/x-compress .Z
#     AddType application/x-gzip .gz .tgz
#     AddType application/x-httpd-php .php
#     AddType applicaiton/x-httpd-php-source .phps
# </IfModule> 

# 重启apache服务器
# /usr/local/httpd/bin/apachectl restart

# 在apache配置文件指向的文件目录中，没有修改的情况下是htdocs文件夹，新建index.php文件
# <?php
#   phpinfo();
# ?>

# 访问服务器ip的80端口可以查看php的配置情况