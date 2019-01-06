<?php
/**
 * 堆栈数据结构的实现
 * 堆栈是一种先进后出的数据结构处理，使用php的代码实现如下
*/
class simpleStack {

    /**
     * @var int
     */
    private $size;

    private $stack = array();
    /**
     * @abstract 构造函数
     * @param $size 堆栈的长度参数
     */
    public function __construct($size){
        $this->size = $size;
    }

    /**
     * @abstract 弹出堆栈的头元素
     */
    public function pop(){
        if(count($this->stack) == 0){
            return false;
        }
        return array_pop($this->stack);
    }

    /**
     * @abstract 在堆栈的头压进新的元素
     */
    public function push($value){
        if(count($this->stack) >= $this->size){
            return false;
        }
        return array_push($this->stack,$value);
    }


    /**
     * @abstract 判断是否是空栈
     */
    public function isEmpty(){
        return current($this->stack) == false;
    }

    /**
     * @abstract 获取堆栈的长度
     */
    public function size(){
        return count($this->stack);
    }

}