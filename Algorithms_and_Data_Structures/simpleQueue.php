<?php
/**
 * 队列数据结构的实现
 * 队列是数据先进先出的数据结构，使用php的代码实现如下
*/
class simpleQueue{
    
    /**
     * @var int 
     */
    private $size;

    /**
     * @var array
     */
    private $queue;


    /**
     * @abstract 构造函数初始化队列长度
     */
    public function __construct($size){
        $this->size = $size;
    }

    /**
     * @abstract 在队列的尾部加入新的元素
     */
    public function add($value){
        if(count($this->queue) >= $this->size){
            return false;
        }
        return array_push($this->queue,$value);
    }

    /**
     * @abstract 弹出队列中的对头元素
     */
    public function shift(){
        if(count($this->queue) == 0){
            return false;
        }
        return array_shift($this->queue);
    }

    /**
     * @abstract 判断队列是否为空
     */
    public function isEmpty(){
        return current($this->queue) == false;
    }

    /**
     * @abstract 获取队列的长度
     */
    public function size(){
        return count($this->queue);
    }
    
}