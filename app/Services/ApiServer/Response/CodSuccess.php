<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class CodSuccess extends BaseResponse implements InterfaceResponse
{
    /**
     * COD支付成功通知
     * A 接收COD支付成功信息
     * B 修改该仓单支付信息，并修改物流状态
     * C 将仓单成功信息推送给惠易定
     * @var string
     */
    protected $method = 'cod.success';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        //A 接收otms货物问题件信息
        // dd($params);
        // echo json_encode($params);exit();
        \Log::info('cod.success接收到的参数是：'.var_export($params,true));

        //B 货物问题件信息发送到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => []
        ];
    }
}