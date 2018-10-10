<?php
//局部静态变量的保有原理示例
function test(){
    static $i = 0;
    $i++;
    echo $i.' ';
}
test();
test();
test();