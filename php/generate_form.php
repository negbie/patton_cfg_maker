<html>

	<head>
		<title> Patton Smartware skb cfg </title>
	</head>

	<body>
		
		<form action="generate.php" method="post">

			<h3> Patton Smartware Skype for Business Config </h3>

				<table border="0" cellpadding="1" cellspacing="2">

					<tr>
					<td>Gateway-Name:</td>
					<td><input name="gatewayName" size="20" placeholder="gateway-to-lync" type="text" required></td>
					</tr>

					<tr>
					<td>DNS-Server1:</td>
					<td><input name="dnsServer1" size="20" placeholder="lynctest.local" type="text" required></td>
					</tr>

					<tr>
					<td>DNS-Server2:</td>
					<td><input name="dnsServer2" size="20" placeholder="lynctest.local" type="text" required></td>
					</tr>

					<tr>
					<td>NTP-Server:</td>
					<td><input name="ntpServer" size="20" placeholder="ntp1.server.de" type="text" required></td>
					</tr>

					<tr>
					<td>WAN-IP:</td>
					<td><input name="wanIp" size="20" placeholder="1.1.1.2" type="text" required></td>
					</tr>

					<tr>
					<td>WAN-Subnet:</td>
					<td><input name="wanSubnet" size="20" placeholder="255.255.255.0" type="text" required></td>
					</tr>

					<tr>
					<td>WAN-Gateway-IP:</td>
					<td><input name="wanGatewayIp" size="20" placeholder="1.1.1.1" type="text" required></td>
					</tr>

					<tr>
					<td>LAN-IP:</td>
					<td><input name="lanIp" size="20" placeholder="192.168.2.66" type="text" required></td>
					</tr>
					<tr>
					<td>LAN-Subnet:</td>
					<td><input name="lanSubnet" size="20" placeholder="255.255.255.0" type="text" required></td>
					</tr>

					<tr>
					<td>Windows-Domain:</td>
					<td><input name="windowsDomain" size="20" placeholder="lynctest.local" type="text" required></td>
					</tr>

					<tr>
					<td>Lync-Server:</td>
					<td><input name="lyncServer" size="20" placeholder="lyncserver.lynctest.local" type="text" required></td>
					</tr>

					<tr>
					<td>Lync-Monitoring-Port:</td>
					<td><input name="lyncMonitoringPort" size="5" placeholder="5068" type="text" required></td>
					</tr>

					<tr>
					<td>Lync-Mediation-Port:</td>
					<td><input name="lyncMediationPort" size="5" placeholder="5066" type="text" required></td>
					</tr>

					<tr>
					<td>Sip-Username:</td>
					<td><input name="username" size="20" placeholder="1001111000" type="text" required></td>
					</tr>

					<tr>
					<td>Sip-Password:</td>
					<td><input name="password" size="20" placeholder="un1c0rnsh1t" type="text" required></td>
					</tr>

					<tr>
					<td>ACME-SIP-Interface:</td>
					<td><input name="acmeIp" size="20" placeholder="192.168.2.88" type="text" required></td>
					</tr>

					<tr>
					<td><br></td>
					</tr>

				</table>
					<table border="0" cellpadding="1" cellspacing="2">
					<tr>
					<td align="center" colspan="2">
					<input name="Send" type="submit" value="OK">
					<input name="Reset" type="reset" value="Reset">
					</td>
					</tr>
			</table>
		</form>
	</body>
</html>
