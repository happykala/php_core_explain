<?php
/**
 * 链表数据结构的php实现
 * 链表分为单项链表，双向链表和循环链表
 * php是不支持指针的，所以没有办法区别单向链表，双向链表和循环链表
 * 在php中有处理实现双向链表的类SplDoublyLinkedList
 * 下面的代码是使用数组模拟实现单向链表
*/
class DirectList{
    /**
     * @var array
     */
    private $list;

    /**
     * @abstract 构造函数初始化链表模拟数组
     */
    public function __construct(){
        $this->list = array(); 
    }

    /**
     * @abstract 获取指定位置的数据
     * @param $index 索引值
     */
    public function get($index){
        $returnValue = NULL;
        while(current($this->list)){
            if(key($this->list) == $index){
                $returnValue = current($this->list);
                break;
            }
            reset($this->list);
            return $returnValue;
        }
    }


    /**
     * @abstract 在模拟链表的指定位置插入数据，默认是在数组的头部插入数据
     * @param $value 准备插入的数据
     * @param $index 数据准备插入的位置 默认的插入位置是链表的头部
     */
    public function add($value,$index=0){
        array_splice($this->list,$index,0,$value);
    }

    /**
     * @abstract 移除指定位置的数据
     * @param $index 需要移除的数组位置
     */
    public function remove($index){
        array_splice($this->list,$index,1);
    }

    /**
     * @abstract 判定链表是否为空
     */
    public function isEmpty(){
        return !isEmpty($this->list);
    }

    /**
     * @abstract 获取链表的长度
     */
    public function Size(){
        return count($this->list);
    }
}