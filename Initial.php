<?php
require_once 'vendor/autoload.php';

use VkApi\Classes\AutoStatus;

$token = 'your-standalone-token';

/*** Autostatus ***/
$autoStatus = new AutoStatus($token,15);
$autoStatus->run();