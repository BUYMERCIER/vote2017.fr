<?php

include("DNS.php");

// torel_check ($ip, $port, $destip) queries the Tor DNS Exit List server.
//   The result of the query is one of the following:
//   -1 : DNS lookup failed to get a response, or other error occurred.
//    0 : $ip does not appear to be a Tor exit.
//    1 : $ip is a known Tor exit for the provided destination IP / port.

function revaddr ($ip) {
  list($a, $b, $c, $d) = split("[.]", $ip);
  return("${d}.${c}.${b}.${a}");
}

function torel_qh ($ip, $port, $destip) {
  $rsrcip = revaddr ($ip);
  $rdstip = revaddr ($destip);
  return("${rsrcip}.${port}.${rdstip}.ip-port.exitlist.torproject.org");
}

function torel_check ($ip, $port, $destip) {
  $ndr = new Net_DNS_Resolver(); 
  $qh = torel_qh($ip, $port, $destip);

  // uncomment these two lines to query the server directly...
  //$ns = "exitlist-ns.torproject.org";
  //$ndr->nameservers( array($ns) );

  // tune DNS params accordingly.  this is just my preference.
  $ndr->retrans = 2;
  $ndr->retry = 3;
  $ndr->usevc = 0;

  // perform DNS query
  if (! $pkt = $ndr->search($qh)) {
    if (strcmp($ndr->errorstring, "NXDOMAIN") == 0) {
      // response but no answer.  does not appear to be Tor exit.
      return (0);
    }
    // search failed: no response or other problem...
    return(-1);
  }
  if (! isset($pkt->answer[0])) {
    // response but no answer section.  does not appear to be Tor exit.
    // (this should only happen when authority sections are provided without answer)
    return(0);
  }
  // is Tor exit
  return(1);
}

// get client request parameters from Apache or equiv server:
$ip = $myip = $myport = 0;
if (isset ($_SERVER["REMOTE_ADDR"])) { $ip = $_SERVER["REMOTE_ADDR"]; }
if (isset ($_SERVER["SERVER_ADDR"])) { $myip = $_SERVER["SERVER_ADDR"]; }
if (isset ($_SERVER["SERVER_PORT"])) { $myport = $_SERVER["SERVER_PORT"]; }

$istor = torel_check($ip, $myport, $myip);

// use $istor as needed for altering page behavior:

 ?>
