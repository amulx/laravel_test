<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class CodRefuse extends BaseResponse implements InterfaceResponse
{
    /**
     * COD签收撤销
     * @var string
     */
    protected $method = 'cod.refuse';
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
        \Log::info('cod.refuse接收到的参数是：'.var_export($params,true));
        $result = DB::table('otms')->where('transport_id',$params['orderno'])->first();
        if (empty($result)) {
            return [
                'status' => true,
                'code'   => '200',
                'data'   => [
                    'result' => '运单不存在'
                ]
            ];
        }
        if ($result->status == '50') {
            $result_data = '运单：'.$params['orderno'].'已经撤销过了，请不要重复操作';
        } else {
            DB::table('otms')
                ->where('transport_id', $params['orderno'])
                ->update(['status' => '50']);
            $result_data = '运单：'.$params['orderno'].'签收撤销成功';
        }
        
        //B 货物问题件信息发送到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => [
                'result' => $result_data
            ]
        ];
    }
}