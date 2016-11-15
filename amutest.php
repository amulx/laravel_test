<?php 
//A 订单模拟数据
// $demand = [
//         [
//             'order_id' => 'order123455666',//
//             'demand_name' =>'货物名称',//必填
//             'demand_num' => 3,//数量  必填
//             'weight' => '3454.00',
//             'volume' => '45.7',
//             'f_company' => '惠美客',//收件单位   必填
//             'f_name' => '谢霆锋',  //收件人   必填
//             'f_mobile' => '18379580432',//收件人手机号  必填
//             'f_province' => '广东省',//必填
//             'f_city' => '广州市',//必填
//             'f_area' => '天河区',//必填
//             'f_town' => '五山路',//必填
//             'f_addr' => '中公教育大厦',//必填
//             't_company' => '煜商信息科技',//收件单位   必填
//             't_name' => '凤姐',  //收件人   必填
//             't_mobile' => '18979580432',//收件人手机号  必填
//             't_province' => '江西省',//必填
//             't_city' => '南昌市',//必填
//             't_area' => '南昌县',//必填
//             't_town' => '某某街道',//必填
//             't_addr' => '具体的地址',//必填
//             'remarks' => '备注', //选填
//             'total_fee' => '345.7'
//             ],[
//             'order_id' => 'order123455668',//
//             'demand_name' =>'货物名称',//必填
//             'demand_num' => 3,//数量  必填
//             'weight' => '3454.00',
//             'volume' => '45.7',
//             'f_company' => '惠美客',//收件单位   必填
//             'f_name' => '谢霆锋',  //收件人   必填
//             'f_mobile' => '18379580432',//收件人手机号  必填
//             'f_province' => '广东省',//必填
//             'f_city' => '广州市',//必填
//             'f_area' => '天河区',//必填
//             'f_town' => '五山路',//必填
//             'f_addr' => '中公教育大厦',//必填
//             't_company' => '煜商信息科技',//收件单位   必填
//             't_name' => '凤姐',  //收件人   必填
//             't_mobile' => '18979580432',//收件人手机号  必填
//             't_province' => '江西省',//必填
//             't_city' => '南昌市',//必填
//             't_area' => '南昌县',//必填
//             't_town' => '某某街道',//必填
//             't_addr' => '具体的地址',//必填
//             'remarks' => '备注', //选填
//             'total_fee' => '345.7'
//             ],[
//             'order_id' => 'order123455669',//
//             'demand_name' =>'货物名称',//必填
//             'demand_num' => 3,//数量  必填
//             'weight' => '3454.00',
//             'volume' => '45.7',
//             'f_company' => '惠美客',//收件单位   必填
//             'f_name' => '谢霆锋',  //收件人   必填
//             'f_mobile' => '18379580432',//收件人手机号  必填
//             'f_province' => '广东省',//必填
//             'f_city' => '广州市',//必填
//             'f_area' => '天河区',//必填
//             'f_town' => '五山路',//必填
//             'f_addr' => '中公教育大厦',//必填
//             't_company' => '煜商信息科技',//收件单位   必填
//             't_name' => '凤姐',  //收件人   必填
//             't_mobile' => '18979580432',//收件人手机号  必填
//             't_province' => '江西省',//必填
//             't_city' => '南昌市',//必填
//             't_area' => '南昌县',//必填
//             't_town' => '某某街道',//必填
//             't_addr' => '具体的地址',//必填
//             'remarks' => '备注', //选填
//             'total_fee' => '345.7'
//             ]
// 	];
// $postData = [
//     'demand' => $demand,
//     'app_id' => 111,
//     'method' => 'order.add',
//     'nonce' => '23444',
//     'sign' =>'44DCBB9F63DC1A23BBE041E74C5EBE6A'
// ];
// 
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
    $postData = [
        'app_id' => 111,
        'method' => 'delivery.notice',
        'nonce' => '23444',
        'sign' =>'AB939030D013F58C60E55B9A4BD60A28',
        'order_id' => 'order123455666'
    ];

// D 发货成功
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'delivery.success',
    //     'nonce' => '23444',
    //     'sign' =>'E3CFD6A0692E7E2EB08660751838B60F',
    // ];

// E 问题件
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'demand.warn',
    //     'nonce' => '23444',
    //     'sign' =>'64FEEA6C4515E681B1F4C55E8D9961B9',
    // ];

// F 签收成功
    // $postData = [
    //     'app_id' => 111,
    //     'method' => 'sign.success',
    //     'nonce' => '23444',
    //     'sign' =>'2288BCAD7237185C91A6BC26723F918A',
    // ];
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
$url = 'http://localhost/ysp_hyd/public/api/router';
echo SendDataByCurl($url,$postData);
// echo strtoupper(md5("111app_id111comhuitongkuaidimethodkuaidinonce23444nu70828177341144111"));//密钥生成
?>