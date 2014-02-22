#SHOUTcast-PHP-Stats

Display stats on your site, such as basic stats, web data stats, detailed listener stats, and song history stats.

#Requirements

These scripts have been targeted for PHP 5.2 or higher.

cURL or `get_file_contents`

##Usage


###`vc_shoutcast.class.php`

A simple class to connect to a SHOUTcast v1 or v2 server and access its admin XML file.

Values from the XML file are returned using PHP's magic `__get` function.

See `demo_sc.php` for some examples.

Please note there are a few name changes and differences between SHOUTcast v1 and v2.
This class assumes you know what version of the SHOUTcast server you are connecting to, and what data you want.

###`vc_shoutcast_json_relay.php`

Uses a `vc_shoutcast` instance to connect to a SHOUTcast server, pull stats and display them as JSON. Includes caching to prevent hammering your SHOUTcast server with requests.

 See `demo_json_relay.php` for an example.

You can configure the cache life time (default: 30 seconds), and the location of the cache (default: `./stats.json`).

As the XML contains sensitive listener data (ie their IP addresses/ user agents), by default the relay removes this information. Three preset sets of sensible values to expose are offered by default:

*  `public_items` - All the information that's available publicly from the SHOUTcast server by default and some safe extras.
* `song_history` - Song history
* `both` - Default option. Both of the above combined.

You can pass one of the above values as a string to `run` to pick. Alternatively, advanced users can pass an array of elements found in the XML file.

Very useful if you want to display stats on your website.  `demo_json_relay.html` shows a basic example of parsing the JSON using jQuery and putting it on your webpage.
