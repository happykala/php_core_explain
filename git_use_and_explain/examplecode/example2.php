<?php
function test(){
    static $i = 0;
    $i++;
    echo $i.' ';
}
test();
test();
test();