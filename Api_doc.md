### API服务端架构代码

1.部署说明  
现有API基于易速派易速派易速派物流接口开发  

1.1. 数据库相关
执行如下SQL语句
```
CREATE TABLE `prefix_apps` (
  `id` INT(10) NOT NULL AUTO_INCREMENT COMMENT '自增长',
  `app_id` VARCHAR(60) NOT NULL COMMENT 'appid',
  `app_secret` VARCHAR(100) NOT NULL COMMENT '密钥',
  `app_name` VARCHAR(200) NOT NULL COMMENT 'app名称',
  `app_desc` TEXT COMMENT '描述',
  `status` TINYINT(2) DEFAULT '0' COMMENT '生效状态',
  `created_at` INT(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` INT(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_id` (`app_id`),
  KEY `status` (`status`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='应用表';
```
1.2. 目录相关

| 标题 | 路径 |
| --- | ---- |
|API核心目录 |	app/Services/ApiServer/ |
|API接口目录|	app/Services/ApiServer/Response/|
|apps数据库模型|	app/Models/App.php|
|路由配置	|app/Http/routes.php|
|API入口控制器|	app/Http/Controllers/Api/RouterController.php|

2.API文档及开发规范

2.1. API调用协议  

2.1.1. 请求地址及请求方式  

请求地址：/api/router;  
请求方式：POST/GET  

2.1.2. 公共参数

|参数名	|类型|	是否必须|	描述|
| ---- | ---- | ---- | ----|
|app_id|	string|	是|	应用ID|
|method	|string	|是|	接口名称|
|format	|string|	否|	回调格式，默认：json（目前仅支持）|
|sign_method|	string|	否	|签名类型，默认：md5（目前仅支持）|
|nonce|	string|	是|	随机字符串，长度1-32位任意字符|
|sign|	string|	是|	签名字符串，参考签名规则|

2.1.3. 业务参数

  API调用除了必须包含公共参数外，如果API本身有业务级的参数也必须传入，每个API的业务级参数请考API文档说明。  

2.1.4. 签名规则

* 对所有API请求参数（包括公共参数和请求参数，但除去sign参数），根据参数名称的ASCII码表的顺序排序。如：foo=1, bar=2, foo_bar=3, foobar=4排序后的顺序是bar=2, foo=1, foo_bar=3, foobar=4。
* 将排序好的参数名和参数值拼装在一起，根据上面的示例得到的结果为：bar2foo1foo_bar3foobar4。
把拼装好的字符串采用utf-8编码，使用签名算法对编码后的字节流进行摘要。如果使用MD5算法，则需要在拼装的字符串前后加上app的secret后，再进行摘要，如：md5(secret+bar2foo1foo_bar3foobar4+secret)
* 将摘要得到的字节结果使用大写表示
2.1.5. 返回结果
```
// 成功
{
    "status": true,
    "code": "200",
    "msg": "成功",
    "data": {
        "time": "2016-08-02 12:07:09"
    }
}

// 失败
{
    "status": false,
    "code": "1001",
    "msg": "[app_id]缺失"
}
```
2.2. API开发规范

2.2.1. API接口命名规范（method）

* 接口名称统一小写字母  
* 多单词用.隔开
* 对应的类文件（目录：app/Services/ApiServer/Response/）；
* 以接口名去.，再首字母大写作为类名及文件名。如接口名：user.add，对应的类文件及类名为：UserAdd
* 接口命名规范  
  * 命名字母按功能或模块从大到小划分，依次编写；如后台用户修改密码：'admin.user.password.update'
  * 字母最后单词为操作。查询:get;新增:add;更新:update;删除:delete;上传:upload;等   
  
2.2.2. 错误码

>错误码配置：app/Services/ApiServer/Error.php

命名规范：  
|类型|	长度|	说明|
| ---- | ---- | ---- |
|系统码	|3|	同http状态码|
|公共错误码|	4|	公共参数错误相关的错误码|
|业务错误码|	6+|	2位业务码+4位错误码，不足补位
现有错误码：

|错误码	|错误内容|
| ---- | ---- |
|200|	成功|
|400|	未知错误|
|401|	无此权限|
|500|	服务器异常|
|1001|	[app_id]缺失|
|1002|	[app_id]不存在或无权限|
|1003|	[method]缺失|
|1004|	[format]错误|
|1005|	[sign_method]错误|
|1006|	[sign]缺失|
|1007|	[sign]签名错误|
|1008|	[method]方法不存在|
|1009|	run方法不存在，请联系管理员|
|1010|	[nonce]缺失|
|1011|	[nonce]必须为字符串|
|1012|	[nonce]长度必须为1-32位|

2.2.3. API DEMO 示例

文件路径：app/Services/ApiServer/Response/Demo.php

3.物流接口

3.1、仓单入库

* API地址：http://域名/public/api/router

* 参数：
```
    'demand' => $demand,
    'app_id' => 111,
    'method' => 'order.add',
    'nonce' => '23444',
    'sign' =>'44DCBB9F63DC1A23BBE041E74C5EBE6A'
```
其中$demand为数组，格式如下：
```
$demand = [
        [
            'order_id' => 'order123455666',//
            'demand_name' =>'货物名称',//必填
            'demand_num' => 3,//数量  必填
            'weight' => '3454.00',
            'volume' => '45.7',
            'f_company' => '惠美客',//收件单位   必填
            'f_name' => '谢霆锋',  //收件人   必填
            'f_mobile' => '18379580432',//收件人手机号  必填
            'f_province' => '广东省',//必填
            'f_city' => '广州市',//必填
            'f_area' => '天河区',//必填
            'f_town' => '五山路',//必填
            'f_addr' => '中公教育大厦',//必填
            't_company' => '煜商信息科技',//收件单位   必填
            't_name' => '凤姐',  //收件人   必填
            't_mobile' => '18979580432',//收件人手机号  必填
            't_province' => '江西省',//必填
            't_city' => '南昌市',//必填
            't_area' => '南昌县',//必填
            't_town' => '某某街道',//必填
            't_addr' => '具体的地址',//必填
            'remarks' => '备注', //选填
            'total_fee' => '345.7'
            ],[
            'order_id' => 'order123455666',//
            'demand_name' =>'货物名称',//必填
            'demand_num' => 3,//数量  必填
            'weight' => '3454.00',
            'volume' => '45.7',
            'f_company' => '惠美客',//收件单位   必填
            'f_name' => '谢霆锋',  //收件人   必填
            'f_mobile' => '18379580432',//收件人手机号  必填
            'f_province' => '广东省',//必填
            'f_city' => '广州市',//必填
            'f_area' => '天河区',//必填
            'f_town' => '五山路',//必填
            'f_addr' => '中公教育大厦',//必填
            't_company' => '煜商信息科技',//收件单位   必填
            't_name' => '凤姐',  //收件人   必填
            't_mobile' => '18979580432',//收件人手机号  必填
            't_province' => '江西省',//必填
            't_city' => '南昌市',//必填
            't_area' => '南昌县',//必填
            't_town' => '某某街道',//必填
            't_addr' => '具体的地址',//必填
            'remarks' => '备注', //选填
            'total_fee' => '345.7'
            ],[
            'order_id' => 'order123455666',//
            'demand_name' =>'货物名称',//必填
            'demand_num' => 3,//数量  必填
            'weight' => '3454.00',
            'volume' => '45.7',
            'f_company' => '惠美客',//收件单位   必填
            'f_name' => '谢霆锋',  //收件人   必填
            'f_mobile' => '18379580432',//收件人手机号  必填
            'f_province' => '广东省',//必填
            'f_city' => '广州市',//必填
            'f_area' => '天河区',//必填
            'f_town' => '五山路',//必填
            'f_addr' => '中公教育大厦',//必填
            't_company' => '煜商信息科技',//收件单位   必填
            't_name' => '凤姐',  //收件人   必填
            't_mobile' => '18979580432',//收件人手机号  必填
            't_province' => '江西省',//必填
            't_city' => '南昌市',//必填
            't_area' => '南昌县',//必填
            't_town' => '某某街道',//必填
            't_addr' => '具体的地址',//必填
            'remarks' => '备注', //选填
            'total_fee' => '345.7'
            ]
	];
```
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果
```
{
	status: true,
	code: "200",
	data: [
	{
		express_id: 1,
		express_name: "顺丰",
		charge_person: "顺丰负责人",
		mobile: "18146645003",
		first_weight: "30",
		created_at: null,
		updated_at: null
	},
	{
		express_id: 1,
		express_name: "顺丰",
		charge_person: "顺丰负责人",
		mobile: "18146645003",
		first_weight: "30",
		created_at: null,
		updated_at: null
	},
	{
		express_id: 1,
		express_name: "顺丰",
		charge_person: "顺丰负责人",
		mobile: "18146645003",
		first_weight: "30",
		created_at: null,
		updated_at: null
	}
	],
	msg: "成功"
}
```

3.2、上门揽件通知
* API地址： http://域名/public/api/router
* 参数
```
    'app_id' => 111,
    'method' => 'delivery.notice',
    'nonce' => '23444',
    'sign' =>'44DCBB9F63DC1A23BBE041E74C5EBE6A',
	'order_id' => 'order123455666',
```
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| order_id| 仓单id |

* 返回结果

3.3、揽件成功通知
* API地址： http://域名/public/api/router
* 参数

* 参数说明
* 返回结果

3.4、物流信息查询
* API地址： http://域名/public/api/router
* 参数
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果

3.5、COD仓单信息查询
* API地址：http://域名/public/api/router
* 参数
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果

3.6、COD支付成功
* API地址：http://域名/public/api/router
* 参数
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果

3.7、仓单签收
* API地址：http://域名/public/api/router
* 参数
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果

3.8、问题件
* API地址：http://域名/public/api/router
* 参数
* 参数说明

| 参数名 | 解释 |
| --- | --- |
| app_id | 应用ID |
| method | 接口名称 |
| nonce | 随机字符串 |
| sign| 签名字符串 |
| demand| 仓单数据数组 |
* 返回结果

