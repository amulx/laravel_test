<?php

namespace App\Http\Controllers\YspInterface;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Log;
use Cache;
class DemandController extends Controller
{
    function objarray_to_array($obj){
        $ret = array();
        foreach ($obj as $key => $value) {
            if (gettype($value) == "array" || gettype($value) == 'object') {
                $ret[$key] = objarray_to_array($value);
            } else {
                $ret[$key] = $value;
            }
            
        }
        return $ret;
    }
    function test(Request $request){
        //A 获取分类名称
        // CREATE TABLE `laravel_class` (
        //   `id` int(11) NOT NULL AUTO_INCREMENT,
        //   `name` varchar(50) DEFAULT NULL,
        //   PRIMARY KEY (`id`)
        // ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
        $classData = DB::table('laravel_class')->where('id', rand(1,3))->first();
        //B 找出分类的图片
        // CREATE TABLE `laravel_code` (
        //   `id` int(11) NOT NULL AUTO_INCREMENT,
        //   `pic` varchar(255) DEFAULT NULL,
        //   `class_id` int(11) DEFAULT NULL,
        //   PRIMARY KEY (`id`)
        // ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
        $codeData1 = DB::table('laravel_code')->where('class_id', $classData->id)->take(2)->get();
        $request->session()->put('class_id', $classData->id);
        $codeData2 = DB::table('laravel_code')->where('class_id', '<>',$classData->id)->take(4)->get();
        $codeData = array_merge($codeData1,$codeData2);
        shuffle($codeData);

        return view('amutest.test',['imgData'=>$codeData,'class_name'=>$classData->name]);
    }

    function codeConfirm(Request $request){
        if ($request->isMethod('POST')) {
            $checkArray = $request->input('checkvalue');
            if (count($checkArray) == 2) {
                $classData = DB::table('laravel_code')->where('class_id', $request->session()->get('class_id'))->get();
                foreach ($classData as $key => $value) {
                    $id_array[] = $value->id;
                }

                if (count(array_intersect($checkArray, $id_array)) == 2) {//取出两个数组的交集
                    return '验证成功';
                }else{
                    return '验证失败';
                }

            }else{
                return '选择错误';
            }
  
        } 
    }
    //利用按位异或实现两个值的交换，而不必使用临时变量
    function changeValue(){
        $a=36;
        $b=112; 
        echo '交换前 $a:'.$a.',$b:'.$b.'<br />';
        $a = $a^$b;//$a=111,$b=110 
        $b = $b^$a;//$a=111,$b=001 
        $a = $a^$b;//$a=110,$b=001 
        echo '交换后$a:'.$a.',$b:'.$b.'<br />';
    }

    function cache1(){
        Cache::put('key1','val1',1);
        dd(Cache::get('key1'));
    }

    function cache2(){
        // $value = Cache::remember('demands', 1, function() {
        $datas = DB::table('demands')->where('order_id', 'order123455666')->get();
            return $datas;
        // });
        // dd($value);
    }

    /**
     * 接收post过来的需求信息
     * 1、根据user_id查找出始发货地址
     * 2、根据货物信息的重量和体积计算出运输该货物所需的总价格
     * 3、将整理好的数据进行简单的匹配  计算出 line_id  express_id  线路id  和物流服务商id
     * 4、将整体数据抛到otms系统中获取运单编号
     * 5、将运单编号和总价格返回给惠易定
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    function storeDemand(Request $request){
    	if ($request->isMethod('POST')) {
    		//一、字段格式验证
    		$postData = $request->input();
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
			dd($postData);
    		//五、返回运单编号和总价格到惠易定
    		
    	}
    	// return $postData;
    }
}
