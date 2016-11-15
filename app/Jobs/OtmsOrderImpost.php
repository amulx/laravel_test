<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use Log;
class OtmsOrderImpost extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $order_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $demands = DB::table('demands')->where('order_id', $this->order_id)->first();//返回StdClass对象
        $demands = $this->objarray_to_array($demands);
        $param['demand'] = $demands;
        $url = 'http://localhost/ysp_hyd/public/openapi/test';//otms的导入订单接口地址
        $this->SendDataByCurl($url,$param);
        Log::info('队列执行结束');
    }

    public function SendDataByCurl($url,$data=array()){
        //对空格进行转义
        $url = str_replace(' ','+',$url);
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch,CURLOPT_TIMEOUT,60);  //定义超时3秒钟  
         // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));    //所需传的数组用http_bulid_query()函数处理一下，就ok了
        
        //执行并获取url地址的内容
        $output = curl_exec($ch);
        $errorCode = curl_errno($ch);
        //释放curl句柄
        curl_close($ch);
        if(0 !== $errorCode) {
            return false;
        }
        return $output;

    }
    public function objarray_to_array($obj){
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
}
