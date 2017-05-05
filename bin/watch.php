<?php
// application.php
namespace PCSS;
$rootPath = dirname(dirname(__FILE__));

require $rootPath.'/vendor/autoload.php';
require $rootPath.'/commands/watchCommand.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands
$application->add(new \PCSS\Command\watchCommand());
$application->run();

