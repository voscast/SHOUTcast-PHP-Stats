<?php
//This work is licensed under the Creative Commons Attribution-No Derivative Works 2.5 Canada License. 
//To view a copy of this license, visit http://creativecommons.org/licenses/by-nd/2.5/ca/ or send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
//You are not permitted to re-distribute modified versions of the script, unless permission has been given. For support, contact support@voscast.com.

include("stats_config.php");  //Location of configuration file
$socket = fsockopen($server_ip, $server_port); //Connects to the SHOUTCast server

if (!$socket) { echo $server_fail; exit; } //Unable to connect to the server

$headers = array("SONGTITLE", "SONGURL", "IRC", "ICQ", "AIM", "WEBHITS", "STREAMHITS", "STREAMSTATUS", "BITRATE", "CONTENT", "VERSION", "WEBDATA", "LISTENERS", "SONGHISTORY", "CURRENTLISTENERS", "PEAKLISTENERS", "MAXLISTENERS", "REPORTEDLISTENERS", "AVERAGETIME", "SERVERGENRE", "SERVERURL", "SERVERTITLE"); //Various Elements
$stats = array(); //Create array that will be used to access the stats
$info = "GET /admin.cgi?pass=$server_pass&mode=viewxml&sid=1 HTTP/1.1\r\n"; //Pull Server Stats
$info .= "User-Agent: Mozilla\r\n\r\n"; //User agent (required to connect)
fputs($socket, $info);

while (!feof($socket)) {
    $xml .= fgets($socket, 1000); //Puts all server stat information into $xml
}

foreach ($headers as $element) {
    $elementlength = strlen("<$element>"); //Gets the length of the element
    $pos1 = strpos($xml, "<$element>") + $elementlength; //Determines starting position of the statistic
    $pos2 = strpos($xml, "</$element>"); //Determines ending position of the statistic
    $length = $pos2 - $pos1; //Determines the length of the statistic
    $value = substr($xml, $pos1, $length); //Using the above information, it pulls the statistic.
    $stats[$element] = $value; //Adds statistic to the array
}
?>