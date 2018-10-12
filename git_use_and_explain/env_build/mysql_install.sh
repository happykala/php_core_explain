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
# 
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






