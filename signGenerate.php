<?php 

// A 仓单导入 密钥生成文件
        
        // 'sign' =>'BED1B0A2C3F190C6C61316912A44D418',
// echo strtoupper(md5("111app_id111methodorder.addnonce23444111"));//密钥生成  44DCBB9F63DC1A23BBE041E74C5EBE6A

// B 发货通知
// method = delivery.notice  'order_id' => 'order123455666'
echo strtoupper(md5("111app_id111methoddelivery.noticenonce23444order_idorder123455666111"));//密钥生成  7EAF2EC5E902E1D1DE3B1D45FE75FF67

// C 发货成功
// echo strtoupper(md5("111app_id111methoddelivery.successnonce23444111"));//密钥生成  E3CFD6A0692E7E2EB08660751838B60F

// D 问题件
// echo strtoupper(md5("111app_id111methoddemand.warnnonce23444111"));//密钥生成  64FEEA6C4515E681B1F4C55E8D9961B9

// E 签收成功  
// echo strtoupper(md5("111app_id111methodsign.successnonce23444111"));//密钥生成  2288BCAD7237185C91A6BC26723F918A
?>