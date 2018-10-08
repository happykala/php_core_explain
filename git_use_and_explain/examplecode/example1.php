<?php
/**
 * @abstract 词法，语法分析示例
 * @author happykala(1030775250@qq.com) 
 * 
*/
$code =<<<PHP_CODE
<?php
$str = "Hello, Tipi\n";
echo $str;
PHP_CODE;

/*token_get_all函数将提供的源码按照PHP的标记进行分割
函数的说明地址如下http://www.php.net/manual/zh/function.token-get-all.php
分割后的标记会由Zend引擎的语法分析器获取到对应的解析代号
解析代号的参考表是http://php.net/manual/zh/tokens.php
*/
// var_dump(token_get_all($code));

$_arrData = token_get_all($code);
foreach($_arrData as $key=>$value){
    if(is_array($value)){
        var_dump(token_name($value[0]));
    }else{
        var_dump($value);
    }
}
