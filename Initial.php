<?php
require_once 'vendor/autoload.php';

use VkApi\Classes\AutoStatus;

/*** Autostatus ***/
$autoStatus = new AutoStatus(15);
$autoStatus->run();