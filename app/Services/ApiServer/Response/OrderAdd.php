<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class OrderAdd extends BaseResponse implements InterfaceResponse
{
    /**
     * 接口名称
     * @var string
     */
    protected $method = 'order.add';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
        // \Log::info('接受的数据是：'.var_export($params,true));
        //一、字段格式验证
        $postData = $params['demand'];
        //三、匹配服务商和线路id
        foreach ($postData as $key => $value) {
            // return $value['totalWeight'];//重量
            $lineData = DB::table('fast_line')
            ->where('f_provice', '=', $value['f_province'])
            ->where('f_city', '=', $value['f_city'])
            ->where('f_area', '=', $value['f_area'])
            ->where('t_provice', '=', $value['t_province'])
            ->where('t_city', '=', $value['t_city'])
            ->where('t_area', '=', $value['t_area'])
            ->first();
            // dd($lineData);
            // echo $lineData->merchant_collection;exit();
                // 线路id为
            $postData[$key]['line_id'] = $lineData->line_id;
            //轻重货判断
            $pzb = ($value['totalVolume']/$value['totalWeight']) > 200.0 ? 'heavy':'light' ;//体积/体重
            // dd($pzb);
            // $pzb = 'heavy';
            //四、生成总价格
            if ($pzb == 'heavy') {
                if ($value['totalWeight'] <= 30 ) {
                    $priceData = DB::select('select *, SUM( ysp_merchants.first_weight *  ysp_fast_heavy.calculate_a + (? - ysp_merchants.first_weight)*continued_a) as total_fee from ysp_fast_heavy left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_heavy.merchant_id where ysp_fast_light.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalWeight'],$lineData->merchant_collection]);
                } else if ((30 < $value['totalWeight']) && ($value['totalWeight'] <= 500)) {
                    $priceData = DB::select('select *, SUM( ysp_merchants.first_weight *  ysp_fast_heavy.calculate_b + (? - ysp_merchants.first_weight)*continued_b) as total_fee from ysp_fast_heavy left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_heavy.merchant_id where ysp_fast_heavy.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalWeight'],$lineData->merchant_collection]);
                } else {
                    $priceData = DB::select('select *, SUM( ysp_merchants.first_weight *  ysp_fast_heavy.calculate_c + (? - ysp_merchants.first_weight)*continued_c) as total_fee from ysp_fast_heavy left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_heavy.merchant_id where ysp_fast_heavy.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalWeight'],$lineData->merchant_collection]);                  
                }
                
            } else {
                if ( $value['totalWeight'] <= 30 ) {
                    $priceData = DB::select('select ysp_merchants.login_account,ysp_merchants.shopuser_name,ysp_merchants.mobile,ysp_merchants.vendorCode,ysp_merchants.merchant_id,ysp_fast_light.valid_time, SUM( ysp_merchants.first_weight *  ysp_fast_light.calculate_a + (? - ysp_merchants.first_weight)*continued_a) as total_fee from ysp_fast_light left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_light.merchant_id where ysp_fast_light.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalVolume'],$lineData->merchant_collection]);
                } else if ((30 < $value['totalWeight']) && ($value['totalWeight'] <= 500)) {
                    $priceData = DB::select('select ysp_merchants.login_account,ysp_merchants.shopuser_name,ysp_merchants.mobile,ysp_merchants.vendorCode,ysp_merchants.merchant_id,ysp_fast_light.valid_time, SUM( ysp_merchants.first_weight *  ysp_fast_light.calculate_b + (? - ysp_merchants.first_weight)*continued_b) as total_fee from ysp_fast_light left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_light.merchant_id where ysp_fast_light.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalVolume'],$lineData->merchant_collection]);
                } else {
                    $priceData = DB::select('select ysp_merchants.login_account,ysp_merchants.shopuser_name,ysp_merchants.mobile,ysp_merchants.vendorCode,ysp_merchants.merchant_id,ysp_fast_light.valid_time, SUM( ysp_merchants.first_weight *  ysp_fast_light.calculate_c + (? - ysp_merchants.first_weight)*continued_c) as total_fee from ysp_fast_light left join ysp_merchants on ysp_merchants.merchant_id = ysp_fast_light.merchant_id where ysp_fast_light.merchant_id in (?) ORDER BY total_fee DESC limit 1',[$value['totalVolume'],$lineData->merchant_collection]);
                }
            }
            $returnData[] = $priceData[0];
            // ysp_merchants.login_account,ysp_merchants.shopuser_name,ysp_merchants.mobile,ysp_merchants.vendorCode,ysp_merchants.merchant_id,ysp_fast_heavy.valid_time
            $postData[$key]['merchant_id'] = $priceData[0]->merchant_id;
            $postData[$key]['total_fee'] = $priceData[0]->total_fee;
            $postData[$key]['vendorCode'] = $priceData[0]->vendorCode;
        }
        $result = DB::table('hyd_order')->insert($postData);
            //匹配物流服务商
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $returnData
        ];
    }
}