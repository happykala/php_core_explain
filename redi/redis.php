<?php
//redis的五种数据类型字符串，哈希，列表，集合，有序集合
/*字符串*/
//字符串的操作set,get,del,mset,mget,inccr,decr,incrby,decrby,incrbyfloat
//字符串的应用场景 缓存信息 user:info:1  计数 购买量，点赞或者播放量 
//共享session 处于负载的考虑有时候用户的访问会被随机的分配到不同的服务器上，建立统一的redis管理的session，避免频繁登录的问题
//短信或者验证码请求限速的问题 set user:code:limit:18963970962 ex 60 nx
//key = user:code:limit:18963970962;
//is_exist = redis.set(key,1,ex,60,nx); 
//if(is_exit != null || redis.incr(key) < 5){ 可以发送 }else{ 不可以发送 }

/*哈希*/
//哈希的操作:hset key filed value/hget key filed/hdel key filed/hlen key/hgetall
//操作hmset key [filed value]..../hmget key [filed]..../hexists key filed/hkeys key/hvals key/hsetnx key [filed value]
//操作hincrby key filed increment/hincrbyfloat key filed incrementfloat/
//操作计算value的字符串长度hstrlen key filed
//哈希的应用场景存储常用的关键的结构化数据，比如一个列表展示的时候与存储展示数据，实现列表加载的毫秒级响应

//列表
//操作 插入rpush key value/ lpush key value/ linsert key after|before piovt value 
//操作 查找 lrange key start end/lindex key index/ llen key  
//操作 删除 rpop key/lpop key/lren key count value/ltrim key start end
//操作 修改 lset key index value
//操作 阻塞操作 blpop [key].... timeout brpop [key].... timeout
//队列的应用场景：1、消息队列  2、存储文章列表列表 3、存储用户的购买产品列表
//常规的数据结构也可以使用列表的命令组合来实现
//队列 lpush rpop
//堆栈 lpush lpop
//消息队列 lpush brpop

//集合 不允许存在重复元素，没有顺序，不可以通过索引还获取到元素的值
//操作 插入 sadd key element.... 删除srem key element...  计算个数 scard key
//操作 判断是否存在 sismember key element... 随机弹出指定个数的元素 srandmember key count 随机弹出一个元素 spop key
//操作 smenmbers key 返回所有集合中的元素
//集合间的操作 sinter key key1...交集  sunion key key1...并集  sdiff key key1... 差集
//集合间操作的时候同时保存到指定的键中 sinterstore destion key key1... 同理并集和差集是一样的
//集合的应用场景 标签 sadd为用户添加标签，为标签添加用户/社交 sadd sinter/随机数sadd/spop,srandmembers

//redis的持久化
//RDB和AOF两种方式

?>