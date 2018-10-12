#  mysql源码安装参数解释
<style>
    table th{
        background: rgba(158,188,226,0.2);
        font-weight:bold
    }
    table td:nth-child(2n+1){
        white-space:nowrap;
    }
    table tbody tr:nth-child(2n){
        background: rgba(158,188,226,0.12);
    }
    table tr:hover{
        background: grey;
    }
</style>
|参数|说明|
|:------|:------|
-DCMAKE_INSTALL_PREFIX | 指向mysql安装目录
-DINSTALL_SBINDIR | 指向可执行文件目录（prefix/sbin）
-DMYSQL_DATADIR | 指向mysql数据文件目录（/var/lib/mysql）
-DSYSCONFDIR | 指向mysql配置文件目录（/etc/mysql）
-DINSTALL_PLUGINDIR | 指向插件目录（prefix/lib/mysql/plugin）
-DINSTALL_MANDIR | 指向man文档目录（prefix/share/man）
-DINSTALL_SHAREDIR | 指向aclocal/mysql.m4安装目录（prefix/share）
-DINSTALL_LIBDIR | 指向对象代码库目录（prefix/lib/mysql）
-DINSTALL_INCLUDEDIR | 指向头文件目录（prefix/include/mysql）
-DINSTALL_INFODIR | 指向info文档存放目录（prefix/share/info）
-DWITH_<ENGINE>_STORAGE_ENGINE | 数据引擎的支持，目前可以支持的是csv,myisam,myisammrg,heap,innobase,archive,blackhole 设置支持的示例  -DWITH_INNOBASE_STORAGE_ENGINE=1 这个是支持innodb模式
-DWITHOUT_<ENGINE>_STORAGE_ENGINE | 数据引擎的禁用，禁用的示例-DWITHOUT_INNOBASE_STORAGE_ENGINE=1
-DWITH_READLINE | 启用readline库支持（提供可编辑的命令行）-DWITH_READLINE=1
-DWITH_SSL | 启用ssl库支持（安全套接层）-DWITH_SSL=system
-DWITH_ZLIB | 启用libz库支持（zib、gzib相关）-DWITH_ZLIB=system
-DWTIH_LIBWRAP | 禁用libwrap库（实现了通用TCP包装的功能，为网络服务守护进程使用） -DWTIH_LIBWRAP=0
-DMYSQL_TCP_PORT | 指定TCP端口为3306 -DMYSQL_TCP_PORT=3306
-DMYSQL_UNIX_ADDR | 指定mysql.sock路径 -DMYSQL_UNIX_ADDR=/tmp/mysqld.sock
-DENABLED_LOCAL_INFILE | 启用本地数据导入支持 -DENABLED_LOCAL_INFILE=1
-DEXTRA_CHARSETS | 启用额外的字符集类型（默认为all）-DEXTRA_CHARSETS=all
-DDEFAULT_CHARSET | 指定默认的字符集为utf8 -DDEFAULT_CHARSET=utf8
-DDEFAULT_COLLATION | 设定默认排序规则（utf8_general_ci快速/utf8_unicode_ci准确） -DDEFAULT_COLLATION=utf8_general_ci
-DWITH_EMBEDDED_SERVER | 编译嵌入式服务器支持 -DWITH_EMBEDDED_SERVER=1
-DMYSQL_USER | 指定mysql用户(默认为mysql) -DMYSQL_USER=mysql
-DWITH_DEBUG | 禁用debug（默认为禁用）-DWITH_DEBUG=0
-DENABLE_PROFILING | 禁用Profiling分析（默认为开启） -DENABLE_PROFILING=0
-DWITH_COMMENT | 一个关于编译环境的描述性注释 -DWITH_COMMENT='string'