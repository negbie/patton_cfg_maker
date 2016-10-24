var generate_template = "\
dns-client server {{dns1}}\n\
dns-client server {{dns2}}\n\
webserver port 80 language en\n\
sntp-client\n\
sntp-client server primary {{ntp1}}\n\
system hostname {{gatewayname}}\n\
\n\
system\n\
\n\
  ic voice 0\n\
\n\
profile napt NAPT_WAN\n\
\n\
profile ppp default\n\
\n\
profile tone-set default\n\
\n\
profile voip default\n\
  codec 1 g711alaw64k rx-length 20 tx-length 20\n\
  codec 2 g711ulaw64k rx-length 20 tx-length 20\n\
  dtmf-relay rtp\n\
\n\
profile pstn default\n\
\n\
profile sip default\n\
  no autonomous-transitioning\n\
\n\
profile aaa default\n\
  method 1 local\n\
  method 2 none\n\
\n\
context ip router\n\
\n\
  interface WAN\n\
    ipaddress {{wanip}} {{wanmask}}\n\
    use profile napt NAPT_WAN\n\
    tcp adjust-mss rx mtu\n\
    tcp adjust-mss tx mtu\n\
\n\
  interface LAN\n\
    ipaddress {{lanip}} {{lanmask}}\n\
    tcp adjust-mss rx mtu\n\
    tcp adjust-mss tx mtu\n\
\n\
context ip router\n\
  route 0.0.0.0 0.0.0.0 {{wangateway}} 0\n\
\n\
context cs switch\n\
  digit-collection timeout 3 set-address-complete-indication\n\
  no digit-collection terminating-char\n\
  digit-collection full-match set-address-complete-indication\n\
  national-prefix 0\n\
  international-prefix 00\n\
\n\
  routing-table called-e164 RT_TO_SIP\n\
    route default dest-interface IF_LYNC MAP_CALLED_E164_INTERNATIONAL\n\
\n\
  routing-table calling-e164 RT_TO_PSTN\n\
    route default dest-interface IF_NC\n\
\n\
  mapping-table called-e164 to called-e164 MAP_CALLED_E164_INTERNATIONAL\n\
    map 00(.%) to +\\1\n\
\n\
  interface sip IF_NC\n\
    bind context sip-gateway GW_SIP\n\
    route call dest-table RT_TO_SIP\n\
    use mapping-table out MAP_CALLED_E164_INTERNATIONAL\n\
    remote {{proxy}}\n\
    local {{proxy}}\n\
\n\
  interface sip IF_LYNC\n\
    bind context sip-gateway GW_LYNC\n\
    route call dest-table RT_TO_PSTN\n\
    remote {{lyncserver}} {{lyncmonitoringport}}\n\
    early-connect\n\
    early-disconnect\n\
    call-reroute accept\n\
    call-reroute emit\n\
    trust remote\n\
\n\
context cs switch\n\
  no shutdown\n\
\n\
authentication-service AUTH_NC\n\
  username {{username}} password {{password}}\n\
\n\
location-service SER_NC\n\
  domain 1 {{proxy}}\n\
\n\
  identity-group default\n\
\n\
    authentication outbound\n\
      authenticate 1 authentication-service AUTH_NC username {{username}}\n\
\n\
    registration outbound\n\
      registrar {{proxy}}\n\
      lifetime 3600\n\
      register auto\n\
\n\
    call outbound\n\
\n\
  identity {{username}} inherits default\n\
\n\
    authentication outbound\n\
      authenticate 1 authentication-service AUTH_NC username {{username}}\n\
\n\
    registration outbound\n\
      registrar {{proxy}}\n\
      lifetime 3600\n\
      register auto\n\
\n\
location-service SER_LYNC\n\
  domain 1 {{windowsdomain}}\n\
  match-any-domain\n\
\n\
  identity-group default\n\
    user phone\n\
\n\
    call outbound\n\
      preferred-transport-protocol tcp\n\
\n\
    call inbound\n\
\n\
context sip-gateway GW_SIP\n\
\n\
  interface IF_GWSIP\n\
    bind interface WAN context router port 5060\n\
\n\
context sip-gateway GW_SIP\n\
  bind location-service SER_NC\n\
  no shutdown\n\
\n\
context sip-gateway GW_LYNC\n\
\n\
  interface IF_GWLYNC\n\
    bind interface LAN context router port {{lyncmediationport}}\n\
\n\
context sip-gateway GW_LYNC\n\
  bind location-service SER_LYNC\n\
  no shutdown\n\
\n\
port ethernet 0 0\n\
  medium auto\n\
  encapsulation ip\n\
  bind interface WAN router\n\
  no shutdown\n\
\n\
port ethernet 0 1\n\
  medium auto\n\
  encapsulation ip\n\
  bind interface LAN router\n\
  no shutdown\n\
\n\
\n\
";
