<?php
namespace App\Services\ApiServer\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
/**
 * api基础类
 * @author Flc <2016-7-31 13:44:07>
 */
abstract class BaseResponse
{
    use DispatchesJobs;
    /**
     * 接口名称
     * 
     * @var [type]
     */
    protected $method;
    /**
     * 返回接口名称
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
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
}