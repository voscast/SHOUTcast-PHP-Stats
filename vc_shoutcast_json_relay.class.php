<?php

/**
* vc_shoutcast_json_relay
*
* Uses a vc_shoutcast instance to connect to a SHOUTcast server, pull stats and display them as JSON.
*/
class vc_shoutcast_json_relay{

	private $vc_shoutcast;

	private $options = array();

	private $items = array();

	
	/**
	 *
	 * Sets SHOUTcast server other settings
	 *
	 * @param	object	$vc_shoutcast		A configured vc_shoutcast object.
	 * @param	int		$cache_lifetime		The lifetime in seconds that the json response should be cached for.
	 * @param	string	$cache_location		The location of the cached json response.
	 *
	 */
	function __construct($vc_shoutcast, $cache_lifetime = 30, $cache_location = './stats.json'){
		$this->vc_shoutcast = $vc_shoutcast;
		$this->vc_shoutcast->get_stats();

		$this->options['cache_location'] = $cache_location;
		$this->options['cache_lifetime'] = $cache_lifetime;

		$public_items = array('CURRENTLISTENERS', 'PEAKLISTENERS', 'MAXLISTENERS', 'REPORTEDLISTENERS', 'SERVERGENRE', 'SERVERURL', 'SERVERTITLE', 'SONGTITLE', 'SONGURL', 'IRC', 'ICQ', 'AIM', 'STREAMSTATUS', 'BITRATE', 'CONTENT', 'VERSION', 'UNIQUELISTENERS', 'NEXTTITLE', 'SONGURL');
		$song_history = array('SONGHISTORY');
		$both = array_merge($public_items, $song_history);

		$this->items['public_items'] = $public_items;
		$this->items['song_history'] = $song_history;
		$this->items['both'] = $both;
	}


	/**
	 *
	 * Typecasts elements in an array
	 *
	 * @param	array	$array	The array to typecast.
	 * @return	array
	 *
	 */
	private function typecast_array($array){

		// array_walk_recursive($array, function (&$item,$key){
		// 	if(is_numeric($item)){
		// 		$item = (int)$item;
		// 	}
		// });

		// PHP 5.2 please die already :(
		$func = create_function('&$item,$key', 'if(is_numeric($item)){$item = (int)$item;}');
		array_walk_recursive($array, $func);

		return $array;
	}

	/**
	 *
	 * Echos JSON with the correct header and exits
	 *
	 * @param	string	$json	The JSON to echo
	 *
	 */
	private function echo_json($json){
 		header('Content-Type: application/json');
		echo $json;
		exit;
	}

	/**
	 *
	 * Pulls info needed for output and displays it
	 *
	 * @param	mixed	$var_set	If a string, one of the premade sets of sensible values to expose
	 *								If an array, an array of values to expose 
	 *
	 */

	public function run($var_set = 'both'){

		if(file_exists($this->options['cache_location']) && filemtime($this->options['cache_location']) > time() - $this->options['cache_lifetime']){
		
			$json = file_get_contents($this->options['cache_location']);
			$this->echo_json($json);
			
		}

		if(is_string($var_set) && isset($this->items[$var_set])){
			$vars = $this->items[$var_set];
		}elseif(is_array($var_set)){
			$vars = $info;
		}else{
			$vars = $this->items['public_items'];
		}

		foreach ($vars as $value) {
			$data[$value] = $this->vc_shoutcast->$value;
		}

		$data = $this->typecast_array($data);
		$json = json_encode($data);

		file_put_contents($this->options['cache_location'], $json);

		$this->echo_json($json);

	}

}