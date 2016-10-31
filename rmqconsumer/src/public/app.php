<?php

require_once realpath(__DIR__.'/../vendor/autoload.php');

use PhpScotland2016\Demo\Service\Impl\Rmq\DemoServiceRmqConsumer;

error_log("Startup");
try {
	$consumer = new DemoServiceRmqConsumer;
	$consumer->execute();
}
catch(\Exception $e) {
	error_log("Exception: ". $e->getMessage());
}
error_log("Terminating");

