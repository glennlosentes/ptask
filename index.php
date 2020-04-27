<?php
require_once __DIR__ . '/vendor/autoload.php';
use ptask\Controllers\ComissionController;




if(count($argv) != 2) die('No input file');
$config = include('./config.php');

$Commissions = new ComissionController($config);
$Commissions->run($argv[1]);