<html sytle="height: 100%;">
<head>
<title>Demonstration</title>
<script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/js/autobahn.min.js"></script>
<script lang="javascript">
jQuery(document).ready(function() {
	var session_id = '';
	var url = "wss://" + window.location.hostname + "/ws";
	console.log("URL:" + url);
	var connection = new autobahn.Connection({
		url: "wss://" + window.location.hostname + "/ws",
		realm: "phpscotland2016"
	});
	connection.onopen = function(session) {
		session_id = session.id;
		console.log("Session ID: " + session.id);
		session.register("io.ajk.phpscotland2016." + session_id, function(args) {
			console.log("RPC " + args);
			var ws_response = jQuery("#ws-response");
			var txt =  ws_response.html();
			txt += "<br/>";
			txt += args[0];
			var a = JSON.parse(args[0]);
			jQuery("#loader-" + a.route).hide();
			var target = jQuery("#"+a.route+"-wsr");
			var prev = target.html();
			var ntxt = prev + '{"hostname":"C:' + a.hostname + '"}<br/>';
			target.html(ntxt);
			console.log("Event:", args[0]);
		});
	};
	connection.onclose = function(reason, details) {
		console.log("Conn close: " + reason);
	};

	connection.open();

	function btnClick(whichBtn) {
		var loaderhtml = '<center><img id="loader-' + whichBtn + '" src="/images/ajax-loader.gif"/></center>';
		jQuery("#" + whichBtn + "-rtn").html(loaderhtml);
		jQuery("#" + whichBtn + "-wsr").html("");
		var times = jQuery("#times").val();
		var wait = jQuery("#wait").val();
		var url = "https://" + window.location.hostname + "/api.php?";
		url += "times=" + times;
		url += "&wait=" + wait;
		url += "&sessionid=" + session_id;
		url += "&type=" + whichBtn;
		jQuery.get(url, function(data) {
			jQuery("#" + whichBtn + "-rtn").html(data);
			console.log(whichBtn + " Response: " + data);
		});
	}
	jQuery("#send-direct").click(function() {
		btnClick("direct");
	});
	jQuery("#send-rmq").click(function() {
		btnClick("rmq");
	});
	jQuery("#send-zmq").click(function() {
		btnClick("zmq");
	});
	jQuery("#send-all").click(function() {
		btnClick("direct");
		btnClick("rmq");
		btnClick("zmq");
	});
});
</script>
</head>
<body sytle="height: 100%; margin: 25px;">
<div style="height: 100%">
<table cellpadding="15" cellspacing="5" border="3" height="100%" width="100%" style="border-color: #000">
    <tr height="8%">
        <td colspan="3" align=center">
            <button id="send-all" value="">Call All Three</button>&nbsp;&nbsp;
            <button id="send-direct" value="">Call Direct</button>&nbsp;&nbsp;
            <button id="send-rmq" value="">Call RMQ</button>&nbsp;&nbsp;
            <button id="send-zmq" value="">Call ZMQ</button>&nbsp;&nbsp;
            Times <input type="text" value="1" size="4" id="times" />&nbsp;&nbsp;
            Wait <input type="text" value="1" size="4" id="wait" />&nbsp;&nbsp;
            <span style="float: right">
		<a href="/talk/index.php" target="_blank">Presentation</a>&nbsp;
		<a href="/links.html" target="_blank">Links</a>&nbsp;
		<a href="/images/demo.png" target="_blank">Diagram</a>
		</span>
        </td>      
    </tr>
    <tr height="92%">
        <td width="33%" valign="top">
            <div id="direct-rtn"><img id="loader-direct" src="/images/ajax-loader.gif" style="display: none;" /></div><p/>
            <div id="direct-wsr"></div><p/>
        </td>
        <td width="33%" valign="top">
            <div id="rmq-rtn"><img id="loader-rmq" src="/images/ajax-loader.gif" style="display: none;" /></div><p/>
            <div id="rmq-wsr"></div><p/>
        </td>
        <td width="33%" valign="top">
            <div id="zmq-rtn"><img id="loader-zmq" src="/images/ajax-loader.gif" style="display: none;" /></div><p/>
            <div id="zmq-wsr"></div><p/>
        </td>
    </tr>
</table>
</div>    
<div id="ws-response"></div>
</body>
</html>

