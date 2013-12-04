<?php

require_once 'vc_shoutcast.class.php';

$vc_shoutcast = new vc_shoutcast('s1.voscast.com', 7000, 'faekpassword');
$vc_shoutcast->get_stats();

header('Content-type: text/plain');

// Get basic details.

echo $vc_shoutcast->SERVERGENRE . PHP_EOL; // Assorted
echo $vc_shoutcast->SERVERTITLE . PHP_EOL; // VosCast Demo


// Get an array of songs played.

print_r ($vc_shoutcast->SONGHISTORY);

// Array
// (
//     [0] => Array
//         (
//             [PLAYEDAT] => 1386116461
//             [TITLE] => orchestral builder
//         )
//  
// ... SNIP ... 
//
// )

// Get an array of listeners.

print_r ($vc_shoutcast->LISTENERS);

// Array
// (
//     [LISTENER] => Array
//         (
//             [0] => Array
//                 (
//                     [HOSTNAME] => 123.123.123.123
//                     [USERAGENT] => Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0
//                     [CONNECTTIME] => 50
//                     [UID] => 0x7f1950001b88
//                 )

//             [1] => Array
//                 (
//                     [HOSTNAME] => 123.123.123.123
//                     [USERAGENT] => Mozilla/5.0 (iPad; CPU OS 7_0_4 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B554a Safari/9537.53
//                     [CONNECTTIME] => 10
//                     [UID] => 0x7f19540019f8
//                 )

//         )

// )