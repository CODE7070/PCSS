<?php
//启动文件，设置一些常用的变量和初始化模板引擎

$pcss_path=dirname(dirname(__FILE__));

require $pcss_path.'/vendor/autoload.php';


//初始化模板引擎
$latte = new Latte\Engine;
//设置临时生成的文件目录，后期这里应该是能够配置的
$latte->setTempDirectory($pcss_path.'/temp');



