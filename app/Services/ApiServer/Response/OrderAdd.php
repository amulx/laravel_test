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
        //一、字段格式验证
        $postData = $params['demand'];
        //三、匹配服务商和线路id
        foreach ($postData as $key => $value) {
            // dd($value);
            $lineData[$key] = DB::table('line')
            ->join('express','express.express_id','=','line.express_collection')
            ->where('f_provice', '=', $value['f_province'])
            ->where('f_city', '=', $value['f_city'])
            ->where('f_area', '=', $value['f_area'])
            ->where('t_provice', '=', $value['t_province'])
            ->where('t_city', '=', $value['t_city'])
            ->where('t_area', '=', $value['t_area'])
            ->select('express.*')
            ->first();
            // dd($lineData);
        }
        $result = DB::table('demands')->insert($postData);
            //匹配物流服务商
        return [
            'status' => true,
            'code'   => '200',
            'data'   => $lineData
        ];
    }
}