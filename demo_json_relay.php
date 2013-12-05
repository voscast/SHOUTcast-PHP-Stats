<?php

require_once 'vc_shoutcast.class.php';
require_once 'vc_shoutcast_json_relay.class.php';

$vc_shoutcast = new vc_shoutcast('s1.voscast.com', 7000, 'faekpassword');

$vc_shoutcast_json_relay = new vc_shoutcast_json_relay($vc_shoutcast, 60);

$vc_shoutcast_json_relay->run('both');

// {

//     "CURRENTLISTENERS": 0,
//     "PEAKLISTENERS": 1,
//     "MAXLISTENERS": 1000,
//     "REPORTEDLISTENERS": null,
//     "SERVERGENRE": "Assorted",
//     "SERVERURL": "http://voscast.com",
//     "SERVERTITLE": "VosCast Demo",
//     "SONGTITLE": "demo_orch",
//     "SONGURL": null,
//     "IRC": null,
//     "ICQ": "N/A",
//     "AIM": null,
//     "STREAMSTATUS": 1,
//     "BITRATE": 128,
//     "CONTENT": "audio/mpeg",
//     "VERSION": "2.0.0.29 (posix(linux x64))",
//     "SONGHISTORY": [
//         {
//             "PLAYEDAT": 1386116562,
//             "TITLE": "demo_orch"
//         },
//         {
//             "PLAYEDAT": 1386116505,
//             "TITLE": "an idia"
//         },
//         {
//             "PLAYEDAT": 1386116461,
//             "TITLE": "orchestral builder"
//         },
//         {
//             "PLAYEDAT": 1386116406,
//             "TITLE": "country rhythm mixout version"
//         },
//         {
//             "PLAYEDAT": 1386116338,
//             "TITLE": "demo_orch"
//         },
//         {
//             "PLAYEDAT": 1386116281,
//             "TITLE": "an idia"
//         },
//         {
//             "PLAYEDAT": 1386116237,
//             "TITLE": "orchestral builder"
//         },
//         {
//             "PLAYEDAT": 1386116171,
//             "TITLE": "demo_orch"
//         },
//         {
//             "PLAYEDAT": 1386116116,
//             "TITLE": "country rhythm mixout version"
//         },
//         {
//             "PLAYEDAT": 1386116058,
//             "TITLE": "an idia"
//         }
//     ]

// }