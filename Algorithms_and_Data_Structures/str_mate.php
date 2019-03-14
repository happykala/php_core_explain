<?php
//字符串匹配的常见算法
//BF排序算法，也叫暴力匹配算法比较好理解，主串和模式串逐一比对，主串上的每一个字符都需要和模式串做匹配，对于主串为n,模式串为m
//的情况下比对的起始位置分别是0,1,2,3....n-m,检查的长度为m,匹配子串的个数为n-m+1

//KMP算法，KMP算法的处理改进的地方时每次匹配时候的其实位置是不定的，主串长度为n,模式串为m，每次匹配的时候在主串中找到和模式串的
//第一个字符匹配的位置作为匹配的起始位置，这样能够减少匹配的次数


//二叉树的处理

//使用链表来表示二叉树
class Node(){
    public $data = '';
    public $left = '';
    public $right = '';

    public function __construct($data){
        $this->data = $data;
    }

    public function per($tree){
        if($tree == null){
            return null;
        }
        print_($tree->data);
        per($tree->left);
        per($tree->right);
    }

    public function mid($tree){
        if($tree == null){
            return null;
        }

        mid($tree->left);
        print_r($tree->data);
        mid($tree->right);
    }

    public function after($tree){
        if($tree == null){
            return null;
        }
        after($tree->left);
        after($tree->right);
        print_r($tree->data);
    }
}

//排序二叉树的构建
class SortedTree(){
    public $tree;

    public function getTree(){
        return $this->tree;
    }


    public function insert($data){
        if(!$this->tree){
            $this->tree = new Node($data);
            return;
        }

        $p = $this->tree;
        while($p){
            if($data < $p->data){
                if(!$p->left){
                    $p->left = new Node($data);
                }
                $p = $p->left;
            }else if($data > $p->data){
                if(!$p->right){
                    $this->tree->right = new Node($data);
                }
                $p = $p->right;
            }
        }
        return $p;
    }


    public function getNode($data){
        if(!$this->tree){
            return null;
        }
        $p = $this->tree;
        while($p){
            if($data > $p->right){
                $p = $p->right; 
            }else if($data < $p->left){
                $p = $p->left;
            }else{
                return $p;
            }
        }
        return null;
    }
}