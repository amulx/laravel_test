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
        dd($params);


        //B 发送货物成功签收信息到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $lineData
        ];
    }
}