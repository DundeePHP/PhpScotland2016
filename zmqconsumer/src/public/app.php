<?php

require_once realpath(__DIR__.'/../vendor/autoload.php');

use PhpScotland2016\Demo\Service\Impl\Zmq\DemoServiceZmqConsumer;

error_log("Startup");

try {
	$consumer = new DemoServiceZmqConsumer;
	$consumer->execute();
}
catch(\Exception $e) {
	error_log("Exception: ". $e->getMessage());
}

error_log("Terminating");
