<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Jobs\OtmsOrderImpost;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class DeliveryNotice extends BaseResponse implements InterfaceResponse
{
    /**
     * 上门揽件通知接口
     * A 接收惠易定可以上门揽件通知
     * B 易速派接收到该消息时将该仓单信息推送到OTMS
     * C 接收OTMS仓单成功入库通知
     * @var string
     */
    protected $method = 'delivery.notice';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        \Log::info('上门揽件通知接口收到的参数：'.var_export($params,true));
        //A 接收惠易定仓单id
        $orderData = $params['demand'];
        foreach ($orderData as $key => $value) {
            $this->dispatch(new OtmsOrderImpost($value['order_id']));
        }

        //A1 通知惠易定我们已经接收到发货通知了
        $notify_msg = [
                'code' => 200,
                'status' => true,
                'data' => $orderData,
            ];
        // $result = $this->SendDataByCurl($hyd_url,$notify_msg);

        //B 在数据库中查找出该仓单数据推送到otms

        //B1 接收otms 通知 易速派 成功接收 订单数据
            //匹配物流服务商
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $orderData
        ];
    }
}