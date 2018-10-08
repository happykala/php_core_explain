**克隆指定的代码库**
-

git clone https://github.com/happykala/php_core_explain.git

在github上克隆下PHP的官方版本

git clone https://github.com/php/php-src.git

![](./picture/2.png '克隆github上的PHP版本库')

切换到PHP7.0的版本

![](./picture/3.png '切换到7.0的版本')

单线程的SAPI的执行过程:

![](./picture/4.png '单线程的SAPI的执行过程')



**php的运行模式**
-
php的运行模式主要有CGI,fastCGI和apache模块这几种方式，目前见到的是
fastcgi和apache模块的方式运行

apache模块方式的解释说明见[链接](http://www.php-internals.com/book/?p=chapt02/02-02-01-apache-php-module)

fastcgi是cgi模式的升级版本，说明解释见[链接](http://www.php-internals.com/book/?p=chapt02/02-02-03-fastcgi)

cgi模式下的运行原理示意图：
![alt](./picture/5.png 'cgi模式下的运行原理示意图')

1、客户端访问 http://127.0.0.1:9003/cgi-bin/user?id=1  
2、127.0.0.1 上监听 9003 端口的守护进程接受到该请求    
3、通过解析 HTTP 头信息，得知是 GET 请求，并且请求的是 /cgi-bin/ 目录下的 user 文件。  
4、将 uri 里的 id=1 通过存入 QUERY_STRING 环境变量。  
5、Web 守护进程 fork 一个子进程，然后在子进程中执行 user 程序，通过环境变量获取到id。  
6、执行完毕之后，将结果通过标准输出返回到子进程。  
7、子进程将结果返回给客户端


fastcgi的运行原理示意图：
![alt](./picture/6.png)

1、FastCGI 进程管理器自身初始化，启动多个 CGI 解释器进程，并等待来自 Web Server 的连接。   
2、Web 服务器与 FastCGI 进程管理器进行 Socket 通信，通过 FastCGI 协议发送 CGI 环境变量和标准输入数据给 CGI 解释器进程。  
3、CGI 解释器进程完成处理后将标准输出和错误信息从同一连接返回 Web Server。  
4、CGI 解释器进程接着等待并处理来自 Web Server 的下一个连接。

**php程序的执行**
-
程序的执行遵循以下的两步：  
1、传递给php程序需要执行的文件， php程序完成基本的准备工作后启动PHP及Zend引擎， 加载注册的扩展模块  
2、初始化完成读取脚本文件之后，Zend引擎对脚本进行词法分析、语法分析。然后编译为opcode。在安装了apc之类的opcode缓存，编译缓解可能被跳过直接从缓存中读取opcode执行。

词法分析的示例-[词法、语法分析示例代码](./examplecode/example1.php)




 








 

