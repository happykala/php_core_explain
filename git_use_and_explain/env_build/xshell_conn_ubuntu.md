## 使用Xshell连接服务器主机（ubuntu14.04为例）

### 1、安装并启动openssh服务
在使用xshell连接ubuntu之前需要服务器组件安装开启了ssh服务  
使用`ps -e | grep ssh`查看是都开启了ssh服务，没有安装和开启的截图如下：
![查看ssh服务的安装和运行状态](../picture/8.png)

使用命令行`sudo apt-get install openssh-server`去安装这个服务  

再次使用`ps -e | grep ssh`查看服务的情况
![查看ssh服务的安装和运行状态](../picture/9.png)
有sshd的情况表示服务已经启动了，没有的情况下使用`/etc/init.d/ssh start`启动即可
![](../picture/10.png)

### 2、查看主机ip
服务器ip查看的命令行`ifconfig`
![查看服务器主机ip](../picture/11.png)

### 3、使用Xshell配置并连接

#### 3.1、新建连接信息
![新建连接信息](../picture/12.png)

#### 3.2、具体的链接信息填写
![具体连接信息的填写](../picture/13.png)

#### 3.2、开始连接
![开始连接](../picture/14.png)

#### 3.3、密码保存方式选择
![密码保存方式选择](../picture/15.png)

#### 3.4、输入用户名和密码
![用户名输入](../picture/16.png)
![密码输入](../picture/17.png)

#### 3.5、连接成功
![连接成功](../picture/18.png)

