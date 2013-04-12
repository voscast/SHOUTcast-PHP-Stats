<?php
//This work is licensed under the Creative Commons Attribution-No Derivative Works 2.5 Canada License. 
//To view a copy of this license, visit http://creativecommons.org/licenses/by-nd/2.5/ca/ or send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
//You are not permitted to re-distribute modified versions of the script, unless permission has been given. For support, contact support@voscast.com.

$listenerelements = array("HOSTNAME", "USERAGENT", "UNDERRUNS", "CONNECTTIME", "POINTER", "UID"); //elements for LISTENERS
$listeners = array(); //Creates array for LISTENERS

$countelements = substr_count($stats[LISTENERS],"<LISTENER>"); //Counts how many times <LISTENER> is in the array...
$countnumber = 1; //We use this to create array numbers

while ($countnumber <= $countelements){ //Continue as long as the number is not greater then the amount of times <LISTENER> was found
    $elementlength = strlen("<LISTENER>"); //Gets the length of the element
    $pos1 = strpos($stats[LISTENERS], "<LISTENER>") + $elementlength; //Determines starting position of the statistic
    $pos2 = strpos($stats[LISTENERS], "</LISTENER>"); //Determines ending position of the statistic
    $length = $pos2 - $pos1; //Determines the length of the statistic
    $value = substr($stats[LISTENERS], $pos1, $length); //Using the above information, it pulls the statistic.

    foreach ($listenerelements as $listenerelementv){
        $elementlength = strlen("<$listenerelementv>"); //Gets the length of the element
        $pos21 = strpos($value, "<$listenerelementv>") + $elementlength; //Determines starting position of the statistic
        $pos22 = strpos($value, "</$listenerelementv>"); //Determines ending position of the statistic
        $length2 = $pos22 - $pos21; //Determines the length of the statistic
        $value2 = substr($value, $pos21, $length2); //Using the above information, it pulls the statistic.
        $listeners[$countnumber][$listenerelementv] = $value2; //Adds statistic to the array
    }

    $replace = "<LISTENER>$value</LISTENER>"; //What we wish to replace (remove)
    $stats['LISTENERS'] = str_replace($replace, "", $stats['LISTENERS']); //Removes the value
    $countnumber = $countnumber + 1; //Increase the count number
}
?>