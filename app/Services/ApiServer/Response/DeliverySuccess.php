<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class DeliverySuccess extends BaseResponse implements InterfaceResponse
{
    /**
     * 揽件成功接口
     * A 接收OTMS订单状态推送消息--提货
     * B 易速派将OTMS传过来的成功提货信息通知到惠易定
     * @var string
     */
    protected $method = 'delivery.success';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        //A 接收otms揽件成功信息
        dd($params);


        //B 发送揽件成功信息到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $lineData
        ];
    }
}