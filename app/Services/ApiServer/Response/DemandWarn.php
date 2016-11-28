<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class DemandWarn extends BaseResponse implements InterfaceResponse
{
    /**
     * 问题件接口
     * A 易速派接收OTMS推送过来的问题数据
     * B 易速派将问题数据推送到惠易定
     * @var string
     */
    protected $method = 'demand.warn';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        //A 接收otms货物问题件信息
        // dd($params);


        //B 货物问题件信息发送到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => [
                "eventTime" => "2015-08-12 13:44:54",       
                "remark" => "order line Exception 破损总数:11;\nnull- test1: 破损: 11;\n", 
                "orderNumber" => $params['transport_id'],    
                "eventId" => 11139,       
                "trackPlate" => "沪 A11113",       
                "eventType" => 22
            ]
        ];
    }
}