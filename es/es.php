<?php
/**
 * Created by PhpStorm.
 * User: lifeng
 * Date: 2019/2/22
 * Time: 16:25
 */
class Bll_OperatePoliceCar extends Bll_BaseLogic{

    /**
     * @abstract 统一入口处理函数
     * @param $param,参数是一个包含两个键值的数组，type表示操作类别，data表示操作数据
     */
    public function process($param){
        if(!array_key_exists('type',$param)){
            return ['code'=> 1,'message' => 'no operate type'];
        }
        switch ($param['type']) {
            case 'insertEsPoliceCar':
                if(array_key_exists('data',$param) && count($param['data']) > 0){
                    if(!array_key_exists('flag',$param) || array_key_exists($param['flag'],['single','multiple'])){
                        return ['code'=> 1,'message' => 'not valid flag'];
                    }else{
                        $result = $this->insertEsPoliceCar($param['flag'],$param['data']);
                        return $result;
                    }
                }else{
                    return ['code'=> 1,'message' => 'no operate data'];
                }
                break;
            case 'deleteEsPoliceCar':
                $result = $this->deleteEsPoliceCar($param['data']['policecarId']);
                return $result;
                break;
            case 'updateEsPoliceCar':
                $result = $this->updateEsPoliceCar($param['data']);
                return $result;
                break;
            case 'searchEsPoliceCar':
                $result = $this->searchEsPoliceCar($param['data']['policecarId']);
                return $result;
                break;
            default:
                return ["code"=> 1,"message" => "unsupported type".$param['type']];
        }
    }


    /**
     * @abstract 存储policecar数据到es的policecar索引中
     * @param $operateFlag 操作符，可取值有两个single和multiple.分别表示数据的单挑插入和批量插入
     * @param $operateData 待插入数据
     */
    public function insertEsPoliceCar($operateFlag,$operateData){
        $Client = Es_EsClient::getClient();
        if($operateFlag == 'single'){
            $params = [
                'index' => 'my_index',
                'type' => 'policecar',
                'body' => $operateData
            ];
            $result = $Client->index($params);
            if($result['result'] == 'created'){
                self::$logger->error('new data add success');
                return ['code' => 0,'message'=>'new data add success'];
            }else{
                self::$logger->error('new data add failed');
                return ['code' => 1,'message'=>'new data add failed'];
            }
        }else if($operateFlag == 'multiple'){
            foreach ($operateData as $key=>$value){
                $params['body'][] = [
                    'index' => [
                        '_index' => 'my_index',
                        '_type' => 'policecar',
                    ]
                ];
                $params['body'][] = $value;
            }
            $result = $Client->bulk($params);
            if($result['errors'] == ''){
                self::$logger->error('new data bulk add success');
                return ['code' => 0,'message'=>'new data bulk add success'];
            }else{
                self::$logger->error('new data bulk add failed');
                return ['code' => 1,'message'=>'new data bulk add failed'];
            }
        }
    }


    /**
     * @abstract 删除制动policeCarId的policeCar数据
     * @param $policeCarId
     */
    public function deleteEsPoliceCar($policeCarId){
        $response = $this->searchEsPoliceCar($policeCarId);
        $response = json_decode($response['data'],true);
        if(count($response['hits']['hits']) == 0){
            self::$logger->error('删除失败当前数据已经不存在');
            return ['code' => 0,'message'=>'delete data not exit'];
        }else{
            $Client = Es_EsClient::getClient();
            $params = [
                'index' => 'my_index',
                'type' => 'policecar',
                'id' => $response['hits']['hits'][0]['_id']
            ];

            $response = $Client->delete($params);
            if($response['result'] == 'deleted'){
                self::$logger->error('删除成功');
                return ['code' => 0,'message'=>'delete success'];
            }else{
                self::$logger->error('删除失败');
                return ['code' => 1,'message'=>'delete failed'];
            }
        }
    }

    /**
     * @param $policeCarId
     */
    public function updateEsPoliceCar($updateData){
        $response = $this->searchEsPoliceCar($updateData['id']);
        $response = json_decode($response['data'],true);
        if(count($response['hits']['hits']) == 0){
            self::$logger->error('需要更新当前的数据不存在');
            return ['code' => 1,'message'=>'update data not exit'];
        }else{
            $Client = Es_EsClient::getClient();
            $params = [
                'index' => 'my_index',
                'type' => 'policecar',
                'id' => $response['hits']['hits'][0]['_id'],
                'body' => [
                    'doc' => $updateData
                ]
            ];
            $response = $Client->update($params);
            if($response['result'] == 'updated'){
                self::$logger->error('更新成功');
                return ['code' => 0,'message'=>'update success'];
            }else{
                self::$logger->error('更新失败');
                return ['code' => 1,'message'=>'update success'];
            }
        }
    }

    /**
     * @abstract 根据policeCardId查询PoliceCar数据
     * @param $policeCarId
     */
    public function searchEsPoliceCar($policeCarId){
        $Client = Es_EsClient::getClient();
        $params = [
            'index' => 'my_index',
            'type' => 'policecar',
            'body' => [
                'query' => [
                    'match' => [
                        'id' => $policeCarId
                    ]
                ]
            ]
        ];
        $response = $Client->search($params);
        return ['code' => 1,'message'=>'search success','data' => json_encode($response)];
    }
}