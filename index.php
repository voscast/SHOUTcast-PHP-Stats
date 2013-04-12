<?php
//This work is licensed under the Creative Commons Attribution-No Derivative Works 2.5 Canada License. 
//To view a copy of this license, visit http://creativecommons.org/licenses/by-nd/2.5/ca/ or send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
//You are not permitted to re-distribute modified versions of the script, unless permission has been given. For support, contact support@voscast.com.

include("stats_basic.php");  	   //REQUIRED (BASIC STATS SUCH AS CURRENT SONG, SERVER TITLE, LISTENER COUNT, ETC)
include("stats_webdata.php");  	   //PROVIDES WEB DATA STATS (NOT NORMALLY NEEDED)
include("stats_listeners.php");    //PROVIDES DETAILS REGARDING EACH LISTENER
include("stats_songhistory.php");  //PROVIDES PREVIOUS SONG NAMES / WHEN THEY WERE PLAYED

fclose($socket); //Closes the socket opened in stats_basic.php

if ($stats['STREAMSTATUS']==1){ //Checks if a DJ is online

    //The following displays various statistics
    echo "<b>BASIC STATISTICS:</b><br><br>";
    echo "Song Title: $stats[SONGTITLE]<br>";
    echo "Song URL: $stats[SONGURL]<br>";
    echo "IRC: $stats[IRC]<br>";
    echo "ICQ: $stats[ICQ]<br>";
    echo "AIM: $stats[AIM]<br>";
    echo "Web Hits: $stats[WEBHITS]<br>";
    echo "Stream Hits: $stats[STREAMHITS]<br>";
    echo "Bitrate: $stats[BITRATE] kbps<br>";
    echo "Content Type: $stats[CONTENT]<br>";
    echo "Server Version: $stats[VERSION]<br>";
    echo "Current Listeners: $stats[CURRENTLISTENERS]<br>";
    echo "Max Allowed Listeners: $stats[MAXLISTENERS]<br>";
    echo "Number of Unique Listeners: $stats[REPORTEDLISTENERS]<br>";
    echo "Average Listener Listening Time: $stats[AVERAGETIME]<br>";
    echo "Server Genre: $stats[SERVERGENRE]<br>";
    echo "Server URL: $stats[SERVERURL]<br>";
    echo "Server Title: $stats[SERVERTITLE]<br>";

    echo "<br><b>ADVANCED STATISTICS:</b><br><br>";
    echo "WEB DATA:<br><br>";
    print_r($webdata); //Displays the web data in an array format
    echo "<br><br>LISTENERS:<br><br>";
    print_r($listeners); //Displays the listener info in an array fromat
    echo "<br><br>SONG HISTORY:<br><br>";
    print_r($songhistory); //Displays the song history in an array format
    echo "<br><br>";

    //EXAMPLE SONG HISTORY USAGE:
    echo 'The song "'.$songhistory[1][TITLE].'" was played on '.date('M d, Y', $songhistory[1][PLAYEDAT]).' at '.date('h:i A', $songhistory[1][PLAYEDAT]).'';
    //$songhistory[1] being the most recent song, $songhistory[2] the second most recent, etc
}
else {
    echo "There is currently no DJ online"; //No DJ online
}
?>