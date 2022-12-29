<?php

class Utils {
	public function __call($name, $arguments) {
		$this->sendOutput('', array('HTTP/1.1 404 Not Found'));
	}//returns void
	
	public function getURIs() {
		$URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$root = '/Modules/';
		$URI = str_replace($root, '', $URI);
		$URI = explode('/', $URI);
		return $URI;
    }//returns array
    
    public function getQueryParams() {
		parse_str($_SERVER['QUERY_STRING'], $query);
		return $query;
    }//returns array
    
    public function sendOutput($data, $headers = array()) {
    	header_remove('Set-Cookie');

		if (is_array($headers) && count($headers)) {
		    foreach ($headers as $header) {
				header($header);
		    }
		}

		echo $data;
		exit;
    }//returns void
}