<?php

// 执行pcss文件的解析工作，并将文件输出
if(!isset($arg)){
    $arg='';
}
$result=$latte->renderToString($pcss_path."/test/src/test.pcss", $arg);
$filename='/'.basename($currenFile);
file_put_contents($destPath.$filename, $result);