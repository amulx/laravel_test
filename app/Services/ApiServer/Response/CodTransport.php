<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class CodTransport extends BaseResponse implements InterfaceResponse
{
    /**
     * COD查看运单信息接口
     * A 接收COD传过来的运单号
     * B 易速派根据该运单号查询到该仓单信息返回给COD
     * @var string
     */
    protected $method = 'cod.transport';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        //A 接收otms货物问题件信息
        dd($params);


        //B 货物问题件信息发送到惠易定
        
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $lineData
        ];
    }
}