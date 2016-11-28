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
        \Log::info('接受到cod发送过来的请求参数为：'.var_export($params,true));
// [2016-11-21 15:55:04] local.INFO: 接受到cod发送过来的请求参数为：array (
//   'sign' => 'FDCD2C486480EB9E276CDF14D4CDE3B4',
//   'nonce' => '13290',
//   'orderno' => '0412345608',
//   'app_id' => '111',
//   'method' => 'cod.transport',
// )   
        $orderno = $params['orderno'];//cod发送过来的运单号
        // dd($orderno);
        //B 货物问题件信息发送到惠易定
      
        return [
            'status' => true,
            'code'   => '200',
            'data'   => [
                'netcode' => '寄件网点编号',
                'netname' => '寄件网点名称',//寄件网点名称
                'weight' => '45',//重量
                'goodscount' => 4,//件数
                'cod' => '0.02',//代收款金额
                'fee' => '0.01',//运费
                'address' => '广东省广州市天河区五山路中公教育大厦1408',//收件地址
                'people' => 'mr chen',//收件人
                'peopletel' => '18979580510',//收件人联系电话
                'status' => '02',//快件状态
                'memo' =>'快件状态正常',//备注
                'dssn' => '343545',//电商编号
                'dsname' => '煜商科技',//电商名称
                'dsorderno' => 'sdfsdf',//电商订单号
                'dlvryno' => '123456',//出库单号
                'buzitype' => 0//业务类型
            ]
        ];
    }
}