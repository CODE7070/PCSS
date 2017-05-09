<?php

// application.php
namespace PCSS;

//将php报错屏蔽掉
error_reporting(0);
$rootPath = dirname(dirname(__FILE__));

require $rootPath.'/vendor/autoload.php';
require $rootPath.'/commands/watchCommand.php';

use Symfony\Component\Console\Application;

$application = new Application();

// 设置版本信息
$application->setName('pcss');
$application->setVersion('0.2.0');


// ... register commands
$application->add(new \PCSS\Command\watchCommand());
$application->run();

