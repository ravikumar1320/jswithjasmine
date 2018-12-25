<?php

#Simple script to purge varnish cache
#Adapted from the script from http://felipeferreira.net/index.php/2013/08/script-purge-varnish-cache/
#This script runs locally on the webserver and will purge all cached pages for the site specified in $hostname
#Modify the $hostname parameter below to match the hostname of your site

$host = 'uk.files.atlas.admiralgroup.lan';

header( 'Cache-Control: max-age=0' );

$port     = '';
$debug    = true;
$URL      =  "/sites/all/staff_pictures/0283.jpg";
$url = $URL;
//$host = $_POST["host"];
 
  $ip = "127.0.0.1";
  $port = "6082";
 
  $timeout = 1;
  $verbose = 1;
 
  # inits
  $sock = fsockopen ($ip,$port,$errno, $errstr,$timeout);
  if (!$sock) { echo "connections failed $errno $errstr"; exit; }
 
  if ( !($url || $host) ) { echo "No params"; exit; }
 
  stream_set_timeout($sock,$timeout);
 
  $pcommand = "purge";
  # Send command
  $pcommand .= ".hash $url#$host#";
 
  put ($pcommand);
  put ("quit");
 
  fclose ($sock);
 
  function readit() {
    global $sock,$verbose;
    if (!$verbose) { return; }
    while ($sockstr = fgets($sock,1024)) {
      $str .= "rcv: " . $sockstr . "
";
    }
    if ($verbose) { echo "$str\n"; }
  }
 
  function put($str) {
    global $sock,$verbose;
    fwrite ($sock, $str . "\r\n");
    if ($verbose) { echo "send: $str 
\n"; }
    readit();
  }
?>