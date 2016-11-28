<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class SignSuccess extends BaseResponse implements InterfaceResponse
{
    /**
     * 接口名称
     * @var string
     */
    protected $method = 'sign.success';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        //A 接收otms货物成功签收信息
        // dd($params);
        DB::table('otms')
            ->where('transport_id', $params['transport_id'])
            ->update(['status' => '30']);

        //B 发送货物成功签收信息到惠易定
        $hyd_url = 'http://10.22.0.122/newb2b2c/public/index.php/tmsnotice/TMSorderNotice';
        $notify_msg = [
            'transport_id' => $params['transport_id'],
            'status' => '揽件成功',
            'identity'=>'HYDSEND'.date('Ymd')
        ];
        $result = $this->SendDataByCurl($hyd_url,$notify_msg);
        \Log::info('揽件成功接口---惠易定返回过来的数据'.var_export($result,true));        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => [
                'transport_id' => $params['transport_id'],
                'desc' => '签收成功'
            ]
        ];
    }
}