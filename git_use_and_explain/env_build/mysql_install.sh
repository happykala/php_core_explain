#!/bin/bash
# 源码安装mysql的过程记录，最终整理成的是一个sh脚本，顺序过程也是手动安装的过程

# 获取安装源码并解压
# 这个源码压缩文件的存放位置根据实际情况可以存在任意位置，推荐存放的路径是/usr/local/src
cd /usr/local/src;
# 源码下载路径可能变化，可以去官网寻找指定版本或者最新版本
wget http://dev.mysql.com/get/Downloads/MySQL-5.6/mysql-5.6.33.tar.gz;
tar -zxvf mysql-5.6.33.tar.gz;

# 安装必要的依赖（这个估计不同版本和不同操作系统变化是最大的,当然已经安装过的依赖可以不用安装）
# 先更新软件包
sudo apt-get update;

apt-get install --yes \
    make \
    cmake \
    bison \
    g++ \
    build-essential \
    libncurses5-dev;

# 使用cmake编译安装(mysql5.5之后的版本需要使用cmake编译安装，所以上面的依赖也安装了cmake)
# 编译安装一个最大的好处是能够控制安装参数，里面参数的可以参考https://blog.csdn.net/sanbingyutuoniao123/article/details/74544634
# 也可以参考本文件同目录下的mysql_parameters_des.md文件
cmake -DCMAKE_INSTALL_PREFIX=/usr/local/mysql \
      -DSYSCONFDIR=/etc \
      -DMYSQL_UNIX_ADDR=/tmp/mysql.sock \
      -DDEFAULT_CHARSET=utf8 \
      -DDEFAULT_COLLATION=utf8_general_ci \
      -DEXTRA_CHARSETS=all \
      -DWITH_MYISAM_STORAGE_ENGINE=1 \
      -DWITH_INNOBASE_STORAGE_ENGINE=1 \
      -DWITH_MEMORY_STORAGE_ENGINE=1 \
      -DWITH_READLINE=1 \
      -DENABLED_LOCAL_INFILE=1 \
      -DMYSQL_DATADIR=/usr/local/mysql/data \
      -DMYSQL_USER=mysql \
      -DWITH_DEBUG=0;   
# 编译完毕之后安装
make && make install && make clean;

# 常用的命令建立软连接
sudo ln -s /usr/local/mysql/lib/libmysqlclient.so.18 /usr/lib/libmysqlclient.so.18;
sudo ln -s /usr/local/mysql/bin/mysql /usr/bin;
sudo ln -s /usr/local/mysql/bin/mysqladmin /usr/bin;

# 新增一个用户用户mysql数据库的初始化,新增用户的命令有两个
# sudo adduser xxx 会新增一个用户，且在home目录下新建一个xxx文件夹，sudo useradd xxx 则只是新建用户不新建文件夹
sudo useradd mysql;
# 为用户配置密码
sudo passwd mysql;
# 把mysql的安装和数据存储目录的操作权限给到当前创建的用户
chown -R mysql:mysql /usr/local/mysql;
chown -R mysql:mysql /usr/local/mysql/data;

# 初始化数据库
sudo /usr/local/mysql/scripts/mysql_install_db --basedir=/usr/local/mysql --datadir=/usr/local/mysql/data --user=mysql 

# 启动mysql的服务
# 再次之前可以查看一下编译安装的etc文件夹下有没有my.cnf的配置文件，没有的情况下可以将mysql安装目录下的配置文件拷贝一份过去
sudo /usr/local/mysql/bin/mysqld --user=mysql      

# 创建root用户并为之设置密码
/usr/local/mysql/bin/mysqladmin -u root password 'root'

# 启动mysql的客户端
/usr/local/mysql/bin/mysql -u root -p
# 输入密码 

#设置环境变量
vim /etc/profile;
# 在文件最后面添加export PATH=$PATH:/usr/local/mysql/bin
# 立即生效
source /etc/profile





