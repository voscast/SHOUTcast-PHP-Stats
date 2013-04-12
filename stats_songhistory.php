<?php
//This work is licensed under the Creative Commons Attribution-No Derivative Works 2.5 Canada License. 
//To view a copy of this license, visit http://creativecommons.org/licenses/by-nd/2.5/ca/ or send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
//You are not permitted to re-distribute modified versions of the script, unless permission has been given. For support, contact support@voscast.com.

$songhistoryelements = array("PLAYEDAT", "TITLE"); //elements for SONGHISTORY
$songhistory = array(); //Creates array for SONGHISTORY

$countelements = substr_count($stats[SONGHISTORY],"<SONG>"); //Counts how many times <SONG> is in the array...
$countnumber2 = 1; //We use this to create array numbers

while ($countnumber2 <= $countelements){ //Continue as long as the number is not greater then the amount of times <LISTENER> was found
    $elementlength = strlen("<SONG>"); //Gets the length of the element
    $pos1 = strpos($stats[SONGHISTORY], "<SONG>") + $elementlength; //Determines starting position of the statistic
    $pos2 = strpos($stats[SONGHISTORY], "</SONG>"); //Determines ending position of the statistic
    $length = $pos2 - $pos1; //Determines the length of the statistic
    $value1 = substr($stats[SONGHISTORY], $pos1, $length); //Using the above information, it pulls the statistic.

    foreach ($songhistoryelements as $songhistoryelementv){
        $elementlength = strlen("<$songhistoryelementv>"); //Gets the length of the element
        $pos31 = strpos($value1, "<$songhistoryelementv>") + $elementlength; //Determines starting position of the statistic
        $pos32 = strpos($value1, "</$songhistoryelementv>"); //Determines ending position of the statistic
        $length3 = $pos32 - $pos31; //Determines the length of the statistic
        $value3 = substr($value1, $pos31, $length3); //Using the above information, it pulls the statistic.
        $songhistory[$countnumber2][$songhistoryelementv] = $value3; //Adds statistic to the array
    }

    $stats[SONGHISTORY] = preg_replace("/<SONG>/", "", $stats[SONGHISTORY], 1); //Removes the value
    $stats[SONGHISTORY] = preg_replace("/<\/SONG>/", "", $stats[SONGHISTORY], 1); //Removes the value
    $countnumber2 = $countnumber2 + 1; //Increase the count number
}
?>