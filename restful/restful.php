<?php
//restful 表述性状态转移，理解起来就是http请求方法和资源的结合
/**
 * @abstract 处理请求的类
 */
class Resquest{
    //定义允许的请求方法
    public static $arrAllowedMethod = array('post','put','get','delete');
    //统一的请求处理函数
    public static function dealRequest(){
        $request_method = $_SERVER['HTTP_METHOD'];
        if(in_array($request_method,self::arrAllowedMethod)){
            $strMethodName = $request_method.'Data';
            return self::$strMethodName($_REQUEST);
        }else{
            return false;
        }
    }

    /**
     * @abstract get处理方法
     */
    public static function getData($requestData){

    }

    /**
     * put处理方法
     */
    public static function putData(){

    }

    /**
     * post处理方法
     */
    public static function postData(){

    }

    /**
     * delete处理方法
     */
    public static function deleteData(){

    }

}


class Response{
   const HTTP_VERSION = 'HTTP/1.1'; 

   /**
    * @abstract 发送response响应
    */
   public static function sendResponse($data){
        if($data){
            $code = 200;
            $message = 'OK';
        }else{
            $code = 400;
            $data = array('error' => 'Not Found');
            $message = 'Not Found';
        }

        //输出结果
        header(self::HTTP_VERSION." ".$code." ".$message);
        $content_type = isset($_SERVER['CONTENT_TYPE'])?$_SERVER['CONTENT_TYPE']:$_SERVER['HTTP_ACCEPT'];
        if(strpos($content_type,'application/json')){
            header('Content-Type:application/json');
            echo self::encodeJson($data);
        }else if(strpos($content_type,'application/xml')){
            header('Content-Type:application/xml');
            echo self::encodeXml($data);
        }else{
            header('Content-Type:application/html');
            echo self::encodeHtml($data);
        }
   }

   /**
    * @abstract json格式打包
    */
   public static function encodeJson($data){
        return json_encode($data);
   }

   /**
    * @abstract xml格式打包
    */
   public static function encodeXml($data){
        $objXml = new SimpleXMLElement('<?xml Version="1.0"?><rest></rest>');
        foreach($data as $key=>$value){
            if(is_array($value)){
                foreach($value as $nextKey=>$nextValue){
                    $objXml->addChild($nextKey,$nextValue);
                }
            }else{
                $objXml->addChild($key,$value);
            }
        }
        return $objXml->asXml();
   }

   /**
    * @abstract html格式打包
    */
   public static function encodeHtml(){
        //使用table格式包裹数据
   }
}
