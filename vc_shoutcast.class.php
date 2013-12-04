<?php

/**
* vc_shoutcast
*
* A simple class to connect to a SHOUTcast v1 or v2 server and access its admin XML file
*
* Values from the XML file are returned using PHP's magic __get function. See the demo for some examples.
* 
* Please note there are a few name changes and differences between SHOUTcast v1 and v2.
* This class assumes you know what version of the SHOUTcast server you are connecting to, and what data you want.
*
*/

class vc_shoutcast{

	private $options = array();

	private $xml;
	
	/**
	 *
	 * Sets connection details
	 *
	 * @param	string	$host		The hostname or IP address of the SHOUTcast server. (example: s1.voscast.com)
	 * @param	int		$port		The port of the SHOUTcast server. (example: 7000)
	 * @param	string	$pass		The **admin** password of the SHOUTcast server.
	 * @param	int		$stream_id	The stream ID of the steam. Not used in SHOUTcast v1.
	 *
	 */
	public function __construct($host = '', $port = 7000, $pass = '', $stream_id = 1){

		$this->options['host'] = $host;
		$this->options['port'] = $port;
		$this->options['pass'] = $pass;
		$this->options['stream_id'] = $stream_id;

	}

	/**
	 *
	 * Sets options
	 *
	 * @param	string	$name	The name of the option to set
	 * @param	string	$value	The value of the option to set
	 *
	 */
	public function __set($name, $value){
		$this->options[$name] = $value;
	}


	/**
	 *
	 * Gets data from the XML file on the SHOUTcast server
	 *
	 * SONGHISTORY is treated as a special case. The conversion from XML to a SimpleXML object is a bit rough,
	 * with the <song> child elements getting merged into one. This function "aliases" SONGHISTORY to SONGHISTORY -> SONG
	 * 
	 * Everything else is just returned untouched.
	 *
	 *
	 * @param	string	$name	The name of the data to set
	 * @return	mixed
	 *
	 */
	public function __get($name){

		if($name == 'SONGHISTORY' && isset($this->xml['SONGHISTORY']) ){
			return $this->xml['SONGHISTORY']['SONG'];

		}elseif(isset($this->xml[$name])){
			return $this->xml[$name];

		}else{
			return null;
		}
	}


	/**
	 *
	 * Gets XML file on the SHOUTcast server
	 *
	 */
	public function get_stats(){
		$data = $this->fetch('http://'.$this->options['host'].':'.$this->options['port'].'/admin.cgi?mode=viewxml&pass=' . $this->options['pass'] . '&sid=' . $this->options['stream_id']);

		if(strtolower($data) == "<html><head>unauthorized<title>shoutcast administrator</title></head></html>"){
			die('Incorrect SHOUTcast admin password.');
		}

		// converts a simplexml object to an array, including all child elements
		$this->xml = json_decode(json_encode((array) @simplexml_load_string($data) ), true);
	}

	/**
	 *
	 * GETs a URL. Attempts to use cURL but falls back to file_get_contents.
	 *
	* @param	string	$name	The name of the data to set
	* @return	string
	 */
	private function fetch($url){

		if(function_exists('curl_version')){

			$ch = curl_init();

			if (is_resource($ch)) {
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_USERAGENT, 'VosCast SHOUTcast Agent (like Mozilla)');
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);

				$data = curl_exec($ch);
				curl_close($ch);

			}

		}elseif(file_get_contents(__FILE__)){

			$data = file_get_contents($url);

		}else{

			die('cURL or file_get_contents need to be enabled.');

		}

		return $data;

	}

}

