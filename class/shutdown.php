<?php

// 执行pcss文件的解析工作，并将文件输出
if(!isset($arg)){
    $arg=array();
}
$pcss_file=dirname($currenFile).'/'.basename($currenFile,'.php').'.pcss';

if(!file_exists($pcss_file)){
    echo "$pcss_file not found!\n";
    return;
}

$result=$latte->renderToString($pcss_file, $arg);

$filename='/'.basename($currenFile,'.php').'.css';

file_put_contents($destPath.$filename, $result);