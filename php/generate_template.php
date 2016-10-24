<?php

function showCfg($gatewayName, $dnsServer1, $dnsServer2, $ntpServer, $lanIp, $lanSubnet, $wanIp, $wanSubnet, $wanGatewayIp, $windowsDomain, $username, $password, $lyncServer, $lyncMonitoringPort, $lyncMediationPort, $acmeIp) {

$CONFIG = '
dns-client server '. $dnsServer1 .'
dns-client server '. $dnsServer2 .'
dns-relay
webserver port 80 language en
sntp-client
sntp-client server primary '. $ntpServer .'
system hostname '. $gatewayName .'

system

  ic voice 0

profile napt NAPT_WAN

profile ppp default

profile tone-set default

profile voip default
  codec 1 g711alaw64k rx-length 20 tx-length 20
  codec 2 g711ulaw64k rx-length 20 tx-length 20
  dtmf-relay rtp

profile pstn default

profile sip default
  no autonomous-transitioning

profile aaa default
  method 1 local
  method 2 none

context ip router

  interface WAN
    ipaddress '. $wanIp .' '. $wanSubnet .'
    use profile napt NAPT_WAN
    tcp adjust-mss rx mtu
    tcp adjust-mss tx mtu

  interface LAN
    ipaddress '. $lanIp .' '. $lanSubnet .'
    tcp adjust-mss rx mtu
    tcp adjust-mss tx mtu

context ip router
  route 0.0.0.0 0.0.0.0 '. $wanGatewayIp .' 0

context cs switch
  digit-collection timeout 3 set-address-complete-indication
  no digit-collection terminating-char
  digit-collection full-match set-address-complete-indication
  national-prefix 0
  international-prefix 00

  routing-table called-e164 RT_TO_SIP
    route default dest-interface IF_LYNC MAP_CALLED_E164_INTERNATIONAL

  routing-table calling-e164 RT_TO_PSTN
    route default dest-interface IF_NC

  mapping-table called-e164 to called-e164 MAP_CALLED_E164_INTERNATIONAL
    map 00(.%) to +\1

  interface sip IF_NC
    bind context sip-gateway GW_SIP
    route call dest-table RT_TO_SIP
    use mapping-table out MAP_CALLED_E164_INTERNATIONAL
    remote '. $acmeIp .'
    local '. $acmeIp .'

  interface sip IF_LYNC
    bind context sip-gateway GW_LYNC
    route call dest-table RT_TO_PSTN
    remote '. $lyncServer .' '. $lyncMonitoringPort .'
    early-connect
    early-disconnect
    call-reroute accept
    call-reroute emit
    trust remote

context cs switch
  no shutdown

authentication-service AUTH_NC
  username '. $username .' password '. $password .'

location-service SER_NC
  domain 1 '. $acmeIp .'

  identity-group default

    authentication outbound
      authenticate 1 authentication-service AUTH_NC username '. $username .'

    registration outbound
      registrar '. $acmeIp .'
      lifetime 3600
      register auto

    call outbound

  identity '. $username .' inherits default

    authentication outbound
      authenticate 1 authentication-service AUTH_NC username '. $username .'

    registration outbound
      registrar '. $acmeIp .'
      lifetime 3600
      register auto

location-service SER_LYNC
  domain 1 '. $windowsDomain .'
  match-any-domain

  identity-group default
    user phone

    call outbound
      preferred-transport-protocol tcp

    call inbound

context sip-gateway GW_SIP

  interface IF_GWSIP
    bind interface WAN context router port 5060

context sip-gateway GW_SIP
  bind location-service SER_NC
  no shutdown

context sip-gateway GW_LYNC

  interface IF_GWLYNC
    bind interface LAN context router port '. $lyncMediationPort .'

context sip-gateway GW_LYNC
  bind location-service SER_LYNC
  no shutdown

port ethernet 0 0
  medium auto
  encapsulation ip
  bind interface WAN router
  no shutdown

port ethernet 0 1
  medium auto
  encapsulation ip
  bind interface LAN router
  no shutdown
';

return $CONFIG;
}

?>
