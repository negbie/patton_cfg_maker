<?php

	include 'generate_template.php';
	$gatewayName = $_REQUEST['gatewayName'];
	$dnsServer1 = $_REQUEST['dnsServer1'];
	$dnsServer2 = $_REQUEST['dnsServer2'];
	$ntpServer = $_REQUEST['ntpServer'];
	$lanIp = $_REQUEST['lanIp'];
	$lanSubnet = $_REQUEST['lanSubnet'];
	$wanIp = $_REQUEST['wanIp'];
	$wanSubnet = $_REQUEST['wanSubnet'];
	$wanGatewayIp = $_REQUEST['wanGatewayIp'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$windowsDomain = $_REQUEST['windowsDomain'];
	$lyncServer = $_REQUEST['lyncServer'];
	$lyncMonitoringPort = $_REQUEST['lyncMonitoringPort'];
	$lyncMediationPort = $_REQUEST['lyncMediationPort'];
	$acmeIp = $_REQUEST['acmeIp'];

	$CONFIG = showCfg($gatewayName, $dnsServer1, $dnsServer2, $ntpServer, $lanIp, $lanSubnet, $wanIp, $wanSubnet, $wanGatewayIp, $windowsDomain,$username,$password, $lyncServer, $lyncMonitoringPort, $lyncMediationPort, $acmeIp);

	echo '<pre>' . $CONFIG . '</pre>';

?>