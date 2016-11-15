<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
/**
 * api测试类
 * @author xxx <2016-11-8 13:44:07>
 */
class Demo extends BaseResponse implements InterfaceResponse
{
    /**
     * 接口名称
     * @var string
     */
    protected $method = 'demo';
    /**
     * 执行接口
     * @param  array &$params 请求参数
     * @return array          
     */
    public function run(&$params)
    {
            //一、字段格式验证
            $postData = $params['demand'];
            // dd($postData);
            //二、查找始发地址
            $userData = DB::table('users')->where('user_id', $postData['user_id'])->first();//返回的是对象类型   后期可以考虑将搜索出来的数据进行缓存
            //三、匹配服务商和线路id
            \Log::info('运行的sql语句是select * from ysp_line where f_provice like "'.$userData->province.'" and f_city like "'.$userData->city.'" and f_area like "'.$userData->area.'" and t_provice like "'.$postData['t_province'].'" and t_city like "'.$postData['t_city'].'" and t_area like "'.$postData['t_area'].'"');

            // $sss = DB::select('select * from ysp_line where f_provice like "?" and f_city like "?" and f_area like "?" and t_provice like "?" and t_city like "?" and t_area like "?"', [$userData->province,$userData->city,$userData->area,$postData['t_province'],$postData['t_city'],$postData['t_area']]);
            $lineData = DB::table('line')
            ->where('f_provice', '=', $userData->province)
            ->where('f_city', '=', $userData->city)
            ->where('f_area', '=', $userData->area)
            ->where('t_provice', '=', $postData['t_province'])
            ->where('t_city', '=', $postData['t_city'])
            ->where('t_area', '=', $postData['t_area'])
            ->first();
                // 线路id为
            $postData['line_id'] = $lineData->line_id;
            //轻重货判断
            $pzb = ($postData['volume']/$postData['weight']) > 200.0 ? 'heavy':'light' ;//体积/体重
            //四、生成总价格
            if ($pzb == 'heavy') {
                if ($postData['weight'] <= 30 ) {
                    $priceData = DB::select('select *, SUM(price.calculate_a * express.first_weight) as total_fee from ysp_heavy_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$lineData->line_id]);
                } else if ((30 < $postData['weight']) && ($postData['weight'] <= 500)) {
                    $priceData = DB::select('select *, SUM(calculate_b * express.first_weight + (? - express.first_weight) * continued_b ) as total_fee from ysp_heavy_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$postData["weight"],$lineData->line_id]);
                } else {
                    $priceData = DB::select('select *, SUM(calculate_c * express.first_weight + (? - express.first_weight) * continued_b ) as total_fee from ysp_heavy_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$postData["weight"],$lineData->line_id]);                   
                }
                
            } else {
                if ( $postData['weight'] <= 30 ) {
                    $priceData = DB::select('select *, SUM( ? * calculate_a) * continued_b ) as total_fee from ysp_light_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$postData['volume'],$lineData->line_id]);
                } else if ((30 < $postData['weight']) && ($postData['weight'] <= 500)) {
                    $priceData = DB::select('select *, SUM( ? * calculate_b ) * continued_b ) as total_fee from ysp_light_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$postData['volume'],$lineData->line_id]);
                } else {
                    \Log::info('我是最大的');
                    $priceData = DB::select('select *, SUM( ? * calculate_c ) as total_fee from ysp_light_price price left join ysp_express express on line_id = ? and price.express_id = express.express_id ORDER BY total_fee DESC limit 1',[$postData['volume'],$lineData->line_id]);
                }
            }
            
            $postData['express_id'] = $priceData[0]->express_id;
            $postData['total_fee'] = $priceData[0]->total_fee;
            return $postData;
    }
}