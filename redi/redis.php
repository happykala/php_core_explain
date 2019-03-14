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


//有序集合 有序集合在集合的基础上为每一个脂新增了分数属性
//操作 插入zadd key score element/获得有序集合的个数 zcard key/获得某个成员的分数 zscore key member
//操作 计算成员的排名 zrank key member zrevrank key member
//操作 删除集合中的成员 zrem key member
//操作 增加成员的分数  zincby key score member
//操作 获取指定范围的集合元素和对应的分数(排名范围) zrange key start end [withscores]/zrevrange key start end [withscores]
//操作 （分数范围）zrangescore key min max [withscores]/zrevrangescore key max min [withscores]
//操作 返回指定分数范围内的元素的个数 zcount key min max 删除指定分数范围内的元素 zremrangebyscore key min max 
//集合间的操作 zinterstore des numbers key[key1....] weight[weight1....] [ag{sum|max|min}]/zunionstore des numbers key[key1...] weight[weight1...] [ag{sum|max|min}]


//键的管理
//重命名 rename key newkey
//过期设置expire time times/timestap
//随机返回一个键值 randomkey

//键值的迁移 dump + restore  dump key restore key 0 'xxxxx'
//redis1.restore(key,0,redis2.dump(key));
//键值的迁移 migrate ip port key|'' db_index timeout [copy] [replace] [keys]
//键的遍历 keys 这个会引起阻塞/ scan 渐进式的遍历
//persist 删除键的过期时间


//redis的慢日志分析
//配置文件或者动态设置两个参数showlog-log-slow-than和showlog-max-len


//redis的持久化

//RDB和AOF两种方式实现持久化
?>