<?php
  
require_once realpath(__DIR__.'/vendor/autoload.php');

ini_set('precision', 16); // Keep Thruway happy.
ini_set("date.timezone", "Europe/London"); // Keep PHP5 quiet.

try {
	$event_loop = React\EventLoop\Factory::create();
	$zmq_ctx = new React\ZMQ\Context($event_loop);
  
	error_log("Opening ZMQ Pull socket...");
	$zmq_pull = $zmq_ctx->getSocket(\ZMQ::SOCKET_PULL);
	$zmq_pull->bind('tcp://*:'.$_ENV["CROSSBAR_ZMQ_PULL_PORT"]);
	$zmq_pull->sessions = array();

	$url = "ws://127.0.0.1:".$_ENV["CROSSBAR_PORT"]."/ws";
	$realm = $_ENV["CROSSBAR_REALM"];

	error_log("Creating Thruway connection: $url");
	$conn = new Thruway\Connection(["realm" => $realm, "url" => $url], $event_loop);
  
	$zmq_pull->on('open', function($msg) {
		error_log("zmq_pull::on::open");
	});
  
	$zmq_pull->on('message', function($msg) use ($zmq_pull) {
		error_log("Received ZMQ Message: " . $msg);
		$arr = json_decode($msg, true);
		if(isset($arr["session_id"])) {
			$uri = "io.ajk.phpscotland2016.".$arr["session_id"];
			error_log("calling $uri");
			foreach($zmq_pull->sessions as $session_id => $session) {
				$session->call($uri, [$msg]);
			}
		}
	});
  
	$conn->on("open", function(Thruway\ClientSession $session) use ($zmq_pull) {
		error_log("Connection::on()::open");
		$zmq_pull->sessions[$session->getSessionId()] = $session;
	});

	$conn->on("close", function($reason) {
		error_log("Connection:on()::close - " . $reason);
	});
  
	$conn->on('error', function ($reason) {
		error_log("conn::on::error - " . $reason);
	});
  
	error_log("Opening connection and running");
	$conn->open();
}
catch(\Exception $e) {
	error_log($e->getMessage());
}

