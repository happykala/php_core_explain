### 单实例安装和启动
java 安装参考 https://www.cnblogs.com/freescience/p/7272070.html

解决elasticsearc不能浏览器访问参考：
https://www.jianshu.com/p/658961f707d8
https://my.oschina.net/codingcloud/blog/1615013


elasticsearch的head插件安装：
有两种处理方法：  
1、谷歌应用市场已经处理好的插件包文件，这个后面下载处理  
2、去github上下载源码安装访问：源码地址https://github.com/mobz/elasticsearch-head  
    首先安装一下git apt-get install git
    然后安装npm apt-get install node-legacy安装的是4.2.6版本太低，可以参考下面的安装：
    https://www.cnblogs.com/you-jia/p/9620172.html
    或者
    https://jingyan.baidu.com/article/f25ef254bbbcb7482c1b82b9.html

    将elasticsearch-head的源码git下来，然后使用npm install安装包文件,然后启动npm start

    启动之后访问ip:9100，修改elasticsearch的IP地址杰克访问

要能够访问还需要修改elasticsearch的配置文件设置跨域的访问限制放开

    vim /XXX/config/elasticsearch.yml,其中XXX为elasticsearch的安装目录

    再最后面添加
    ```
    http.cors.enabled: true
    http.cors.allow-origin: "*"
    ```    

### 分布式安装和启动

master节点配置文件新增配置：  
cluster.name: happykala //集群名称  
node.name: master //设置当前节点名字为master  
node.master: true //设置当前节点是master节点

network.host: 127.0.0.1 //制定ip 端口使用默认的9200

源码安装过程和主节点是一致的，起一个文件夹名字不一样即可
slaver节点配置文件新增配置：  
cluster.name: happykala  
node.name: slaver1

network.host: 0.0.0.0  
http.port: 8200

discovery.zen.ping.unicast.hosts: ["0.0.0.0"]


### 基础概念
索引  类型  文档

### 索引创建
api的基础格式:
http://ip:port/<索引>/<类型>/<文档id>

常用的http动作：
GET/PUT/POST/DELETE



1、php基础语法

2、mysql数据库基础

3、缓存redis

4、全文查询处理
es

5、大流量高并发的处理

6、消息系统的使用

7、算法

8、前端能力