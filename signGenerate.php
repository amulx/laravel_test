<?php 

// A 仓单导入 密钥生成文件
        
        // 'sign' =>'BED1B0A2C3F190C6C61316912A44D418',
// echo strtoupper(md5("111app_id111methodorder.addnonce23444111"));//密钥生成  44DCBB9F63DC1A23BBE041E74C5EBE6A

// B 发货通知
// method = delivery.notice  'order_id' => 'order123455666'
// echo strtoupper(md5("111app_id111methoddelivery.noticenonce23444111"));//密钥生成  7EAF2EC5E902E1D1DE3B1D45FE75FF67

// C 发货成功


        
// echo strtoupper(md5("111app_id111methoddelivery.successnonce23444order_idorder123455666provider_noqweeshop_noadsasdstransport_idtransport_num111"));//密钥生成  3BFA968DE92AE19BE7BD0E5249B92BA4

// D 问题件


// echo strtoupper(md5("111app_id111methoddemand.warnnonce23444provider_noqweeshop_noadsasdstransport_idtransport_num111"));//密钥生成  64FEEA6C4515E681B1F4C55E8D9961B9

// E 签收成功  
// echo strtoupper(md5("111app_id111methodsign.successnonce23444provider_noqweeshop_noadsasdstransport_idtransport_num111"));//密钥生成  2288BCAD7237185C91A6BC26723F918A
// 
// F COD运单查询
// echo strtoupper(md5("111app_id111methodcod.transportnonce23444orderno1231231231232111"));//密钥生成  C9C3FF0AC0BA13445A2CDBE239AA38E7

//G COD支付成功接口
// echo strtoupper(md5("111app_id111methodcod.successnonce23444orderno1231231231232111"));//密钥生成  C9C3FF0AC0BA13445A2CDBE239AA38E7

//H 签到  
        
// echo strtoupper(md5("111app_id111employnoaccountmethodysp.signinnonce23444passwdpasswdtermidtermid111"));//密钥生成  C9C3FF0AC0BA13445A2CDBE239AA38E7
// 
// 
// 
// I COD签收撤销
// 
    $postData = [
        'app_id' => 111,
        'method' => 'cod.refuse',
        'nonce' => '23444',
        'orderno' => 'order123455666', //运单号
        'cod' => 'cod',//代收款金额
        'cardid' => 'cardid',//银行卡号
        'banktrace' => 'banktrace',//银行系统参考号
        'postrace' => 'postrace',//pos机的流水号
    ];


        ksort($postData);
        // dd($this->app_secret);
        $tmps = array();
        foreach ($postData as $k => $v) {
            if ($k == 'demand') {
                continue;
            }
            $tmps[] = $k . $v;
        }

        $string = '111'. implode('', $tmps) . '111';
        // echo "{$string}";exit();
        echo strtoupper(md5($string));

?>