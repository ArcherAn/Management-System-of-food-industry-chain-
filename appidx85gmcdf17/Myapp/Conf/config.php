<?php
$host = getenv('HTTP_BAE_ENV_ADDR_SQL_IP');
$port = getenv('HTTP_BAE_ENV_ADDR_SQL_PORT');
$user = 'MnFupcgk8XF3rI3roXMyhdvd';
$pwd = 'EGHlaNA4WwlYwbFEC893lPLGFr0xRFUL';


return array(
//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',
	//连接到哪台数据库服务器
	//数据信息同步
	
	//utf8
	// DB_CHARSET
	//DB_FIELDS_CACHE=false,
	//DB_FIELDTYPE_CHECK=false,
	'TMPL_CACHE_ON'=>false,      // 默认开启模板缓存
	'TMPL_CACHE_ON'   => false,  // 默认开启模板编译缓存 false 的话每次都重新编译模板
	'TMPL_PARSE_STRING'=> array('__PUBLIC__' => '../Public'),
	'ACTION_CACHE_ON'  => false,  // 默认关闭Action 缓存

	'HTML_CACHE_ON'   => false,   // 默认关闭静态缓存
	'DB_HOST'=>$host,
	'DB_NAME'=>'khiOLOBjpPFrzIYABLhF',  //如果数据库名都相同的话，你可以不用定义多个
	'DB_USER'=>$user,
	'DB_PWD'=>$pwd ,
	'DB_PORT'=>$port,
	'DB_PREFIX'=>'',
	'TEMPLATE_CHARSET'        =>        'utf-8',        // 模板文件编码
    'OUTPUT_CHARSET'        =>        'utf-8',        // 默认输出编码
    'DB_CHARSET'        =>        'utf8',        // 数据库编码默认采用utf8
	'URL_CASE_INSENSITIVE' =>false,
	'TMPL_L_DELIM'=>'<{',
	'TMPL_R_DELIM'=>'}>',
	 'APP_GROUP_LIST' => 'Seedlings,Plant,Warehouse,Process,Deepprocess,User,Map,Suyuan,Trace,Parse',
    'DEFAULT_GROUP' =>'Seedlings',
	'QR_CODE_URL'=>'http://qr.liantu.com/api.php?&w=100&m=5&text=',

	);