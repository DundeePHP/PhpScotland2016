<?php

$context = new \ZMQContext(1, true);

$frontend = $context->getSocket(\ZMQ::SOCKET_REP);
$frontend->bind("tcp://*:" . $_SERVER["ZMQ_BROKER_FRONT_PORT"]);

$backend  = $context->getSocket(\ZMQ::SOCKET_PUSH);
$backend->bind("tcp://*:" . $_SERVER["ZMQ_BROKER_BACK_PORT"]);

$run = true;

if(extension_loaded("pcntl")) {
	pcntl_signal(SIGTERM, function($signo) {
		$run = false;
	});
}

while($run) {
    try {
        $message = $frontend->recv(\ZMQ::MODE_NOBLOCK);
	if(is_string($message) && !empty($message)) {
		error_log("Message: $message");
		$backend->send($message, \ZMQ::MODE_NOBLOCK);
		$frontend->send('{"result": "ok"}', \ZMQ::MODE_NOBLOCK);
	}
	else {
		usleep(10);
	}
    }
    catch(\Exception $e) {
        error_log($e->getMessage());
    }
}

error_log("Terminating");

