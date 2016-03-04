<?php
ini_set('display_errors', 'Off');

if(empty($argv[1])){
	echo 'please add a file or a dir to watch';
	die;
}

if(empty($argv[2])){
	echo 'please add a dir to output';
	die;
}
include '../class/watch.class.php';
$watch=new watch();
$watch->watch($argv[1],$argv[2]);
?>
