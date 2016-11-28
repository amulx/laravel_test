<?php 
//A 订单模拟数据
// $demand = [
//         [
//             'order_id' => 'order123455666',//
//             'demand_name' =>'货物名称',//必填
//             'f_companyName' => '惠美客',//收件单位   必填
//             'f_postcode' => '334604',
//             'f_name' => '谢霆锋',  //收件人   必填
//             'f_mobile' => '18379580432',//收件人手机号  必填
//             'f_province' => '广东省',//必填
//             'f_city' => '广州市',//必填
//             'f_area' => '天河区',//必填
//             'f_town' => '五山街道',//必填
//             'f_addr' => '中公教育大厦',//必填
//             'f_phone' => '0793-2693000',
//             'f_phoneAreaCode' => '0793',
//             'f_email' => 'sdfdf@qq.com',
//             't_companyName' => '煜商信息科技',//收件单位   必填
//             't_postcode' => '334509',
//             't_name' => '凤姐',  //收件人   必填
//             't_mobile' => '18979580432',//收件人手机号  必填
//             't_province' => '广东省',//必填
//             't_city' => '广州市',//必填
//             't_area' => '荔湾区',//必填
//             't_town' => '某某街道',//必填
//             't_addr' => '具体的地址',//必填
//             't_phone' => '0793-2693001',
//             't_phoneAreaCode' => '0793',
//             't_email' => 'sdfdf@qq.com',
//             'totalQuantity'=>'456',
//             'totalWeight' =>'789',
//             'totalVolume' => '90',
//             'cargoType'=>'货物类型',
//             'packageType' =>'包装类型',
//             'pay_type' => 'online',
//             'total_fee' => '45',
//             'pay_time' => 23434
//             ],
//         [
//             'order_id' => 'order123455666',//
//             'demand_name' =>'货物名称',//必填
//             'f_companyName' => '惠美客',//收件单位   必填
//             'f_postcode' => '334604',
//             'f_name' => '谢霆锋',  //收件人   必填
//             'f_mobile' => '18379580432',//收件人手机号  必填
//             'f_province' => '广东省',//必填
//             'f_city' => '广州市',//必填
//             'f_area' => '天河区',//必填
//             'f_town' => '五山路',//必填
//             'f_addr' => '中公教育大厦',//必填
//             'f_phone' => '0793-2693000',
//             'f_phoneAreaCode' => '0793',
//             'f_email' => 'sdfdf@qq.com',
//             't_companyName' => '煜商信息科技',//收件单位   必填
//             't_postcode' => '334509',
//             't_name' => '凤姐',  //收件人   必填
//             't_mobile' => '18979580432',//收件人手机号  必填
//             't_province' => '广东省',//必填
//             't_city' => '广州市',//必填
//             't_area' => '越秀区',//必填
//             't_town' => '某某街道',//必填
//             't_addr' => '具体的地址',//必填
//             't_phone' => '0793-2693001',
//             't_phoneAreaCode' => '0793',
//             't_email' => 'sdfdf@qq.com',
//             'totalQuantity'=>'456',
//             'totalWeight' =>'789',
//             'totalVolume' => '90',
//             'cargoType'=>'货物类型',
//             'packageType' =>'包装类型',
//             'pay_type' => 'online',
//             'total_fee' => '45',
//             'pay_time' => 23434
//             ]
// 	];
// $postData = [
//     'demand' => $demand,
//     'app_id' => 111,
//     'method' => 'order.add',
//     'nonce' => '23444',
//     'sign' =>'44DCBB9F63DC1A23BBE041E74C5EBE6A'
// ];

// B  快递查询模拟数据
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'kuaidi',
    //     'nonce' => '23444',
    //     'sign' =>'BED1B0A2C3F190C6C61316912A44D418',
    //     'com' => 'huitongkuaidi',//快递公司编码
    //     'nu' => '70828177341144' //快递单号
    // ];
    
// C 发货通知   
// $demand = [
//     ['order_id' => 'order123455666',],
//     ['order_id' => 'order123455667',]
// ];
//     $postData = [
//         'app_id' => 111,
//         'method' => 'delivery.notice',
//         'nonce' => '23444',
//         'sign' =>'7EAF2EC5E902E1D1DE3B1D45FE75FF67',
//         'demand' => $demand,
//     ];

// D 发货成功
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'delivery.success',
    //     'nonce' => '23444',
    //     'order_id' => 'order123455666',
    //     'shop_no' => 'adsasds',//电商编码
    //     'provider_no' => 'qwee',//供应商编码
    //     'transport_id' => 'transport_num',//快递单号
    //     'sign' =>'928DA3454E2660686181915AF593843A',
    // ];

// E 问题件
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'demand.warn',
    //     'nonce' => '23444',
    //     'shop_no' => 'adsasds',//电商编码
    //     'provider_no' => 'qwee',//供应商编码
    //     'transport_id' => 'transport_num',//快递单号
    //     'sign' =>'31B1F7344F1D31BEC1B27376C951D97C',
    // ];

// F 签收成功
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'sign.success',
    //     'nonce' => '23444',
    //     'shop_no' => 'adsasds',//电商编码
    //     'provider_no' => 'qwee',//供应商编码
    //     'transport_id' => 'transport_num',//快递单号
    //     'sign' =>'061AD1BAF472BA4261EE9FB246D9D6F0',
    // ];
// G COD运单查询
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'cod.transport',
    //     'nonce' => '23444',
    //     'orderno' => '1231231231232',
    //     'sign' =>'47702CB8C7F2A13C38DC99F05274A4CD',
    // ];
// G COD支付成功
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'cod.success',
    //     'nonce' => '23444',
    //     'orderno' => 'order123455666',
    //     // 'sign' =>'C865630EC3DAF1F5A9854A18028BB3B6',
    // ];
// H 签到接口
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'ysp.signin',
    //     'nonce' => '23444',
    //     'employno' => 'account', //帐号
    //     'passwd' => 'passwd',//密码
    //     'termid' => 'termid',//终端号
    //     'sign' =>'8AAB663703E26610C8D4CB88B547E393',
    // ];
// G  COD签收撤销
    $postData = [
        'app_id' => 111,
        'method' => 'cod.refuse',
        'nonce' => '23444',
        'orderno' => 'order123455666', //运单号
        'cod' => 'cod',//代收款金额
        'cardid' => 'cardid',//银行卡号
        'banktrace' => 'banktrace',//银行系统参考号
        'postrace' => 'postrace',//pos机的流水号
        // 'sign' =>'1584D0484CEBA36B90935681B6BC1DD2',
    ];
    //        'identity'=>'HYDSEND'.date('Ymd') 发送给HYD参数
function SendDataByCurl($url,$data=array()){
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

// $url = 'http://localhost/ysp_hyd/public/openapi/storeDemand';
// $url = 'http://localhost/ysp_hyd/public/api/router';
$url = 'http://120.25.197.101:8081/api/router';
// $url = 'http://10.22.0.108/newb2b2c/public/index.php/tmsnotice/deliverySuccess';

ksort($postData);
$tmps = array();
foreach ($postData as $k => $v) {
    if ($k == 'demand') {
        continue;
    }
    $tmps[] = $k . $v;
}
$string = '111'. implode('', $tmps) . '111';
$postData['sign'] = strtoupper(md5($string));

echo SendDataByCurl($url,$postData);
// echo strtoupper(md5("111app_id111comhuitongkuaidimethodkuaidinonce23444nu70828177341144111"));//密钥生成
?>