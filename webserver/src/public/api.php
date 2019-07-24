<?php
$start = microtime(true);
require_once __DIR__.'/../vendor/autoload.php';
use PhpScotland2016\Demo\Service\Interfaces\DemoServiceRequest;
use PhpScotland2016\Demo\Service\Interfaces\DemoServiceResponse;

use PhpScotland2016\Demo\Service\Impl\Zmq\DemoServiceZmqProducer;
use PhpScotland2016\Demo\Service\Impl\Rmq\DemoServiceRmqProducer;
use PhpScotland2016\Demo\Service\Impl\Direct\DemoServiceImplDirect;

function factory($type) {
	switch($type) {
		case "zmq": return new DemoServiceZmqProducer;
		case "rmq": return new DemoServiceRmqProducer;
		default: return new DemoServiceImplDirect;
	}
}

function htmljson($json) {
	return str_replace(",", ",<br/>&nbsp;&nbsp;", $json);
}

$logs = [];
$counter = 0;
$responses = [];
try {
	$session_id = isset($_GET['sessionid']) ? (int)$_GET['sessionid'] : null;
	if(is_null($session_id)) {
		throw new \Exception("No sessionid provided");
	}
	$type = isset($_GET['type']) ? $_GET['type'] : "direct";
	$wait = isset($_GET['wait']) ? (int)$_GET['wait'] : 1;
	$times = isset($_GET['times']) ? (int)$_GET['times'] : 1;
	while($times > 0) {
		$request = new DemoServiceRequest;
		$request->setParam("route", $type);
		$request->setParam("wait_for", $wait);
		$request->setParam("session_id", $session_id); 
		$request->setParam("promise_idx", $counter); 
		$impl = factory($type);
		$response = $impl->handleRequest($request);
		$arr = $response->getArray();
		$display = [];
		$display["hostname"] = "W:" . (isset($arr["hostname"]) ? $arr["hostname"] : gethostname());
		$display["class"] = ($type == "direct" ? "promise_complete" : "promise_waiting");
		$display["promise_idx"] = $counter;
		if(isset($arr['msg'])) $display["msg"] = $arr["msg"];
		$responses[] = json_encode($display, JSON_FORCE_OBJECT);
		$times--;
		$counter++;
	}
	$response = "[" . implode(",", $responses) . "]";
	header("Content-Type: application/json");
	echo $response;
	exit(0);
}
catch(\Exception $e) {
	$logs[] = $e->getMessage();
}
$end = microtime(true);
?>
<strong>API/<?php print $type; ?></strong><br/>
<strong>Start   = <?php print $start; ?></strong><br/>
<strong>End     = <?php print $end; ?></strong><br/>
<strong>Time    = <?php print $end - $start; ?></strong><br/>
<strong>Counter = <?php print $counter; ?></strong>
<pre>
_GET
<?php print_r($_GET); ?>
<?php if(count($logs)) print_r($logs); ?>
</pre>
<?php foreach($responses as $json){ echo htmljson($json)."<br/>\n"; } ?>

