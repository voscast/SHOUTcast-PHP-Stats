<?php
//This work is licensed under the Creative Commons Attribution-No Derivative Works 2.5 Canada License. 
//To view a copy of this license, visit http://creativecommons.org/licenses/by-nd/2.5/ca/ or send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
//You are not permitted to re-distribute modified versions of the script, unless permission has been given. For support, contact support@voscast.com.

$webdataelements = array("INDEX", "LISTEN", "PALM7", "LOGIN", "LOGINFAIL", "PLAYED", "COOKIE", "ADMIN", "UPDINFO", "KICKSRC", "KICKDST", "UNBANDST", "BANDST", "VIEWBAN", "UNRIPDST", "RIPDST", "VIEWRIP", "VIEWXML", "VIEWLOG", "INVALID"); //elements for WEBDATA
$webdata = array(); //Creates array for WEBDATA

foreach ($webdataelements as $webdataelementv){
    $elementlength = strlen("<$webdataelementv>"); //Gets the length of the element
    $pos1 = strpos($stats[WEBDATA], "<$webdataelementv>") + $elementlength; //Determines starting position of the statistic
    $pos2 = strpos($stats[WEBDATA], "</$webdataelementv>"); //Determines ending position of the statistic
    $length = $pos2 - $pos1; //Determines the length of the statistic
    $value = substr($stats[WEBDATA], $pos1, $length); //Using the above information, it pulls the statistic.
    $webdata[$webdataelementv] = $value; //Adds statistic to the array
}
?>