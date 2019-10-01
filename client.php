<?php

	class RestClient{
		public $host;
		public $port;
		public $socket;
		const GET = "GET";
		const POST = "POST";
		const PUT = "PUT";
		const DELETE = "DELETE";
		
		public function __construct($host, $port=80){
			$this->host = $host;
			$this->port = $port;
		}
		public function parseResult($socket){
			$res = "";
			while(!feof($socket)){
				$res.=fgets($socket);
			}
			$res = explode("\r\n\r\n", $res);
			fclose($socket);
			return $res[1];
		}	
		public function doRequest($method, $doc="", $params=null){
			$socket = fsockopen($this->host,$this->port);
			if($params){
				$params_str = "";
				foreach($params as $k=>$v){
					$params_str.=$k."=".$v."&";
				}
				$params_str = rtrim($params_str, "&");
				$params = $params_str;
			}
			$getparam = "";
			$postparam = "";
			if($method == RestClient::GET or $method == RestClient::DELETE){
				$getparam = ($params)?"?$params":"";
			}else{
				$postparam = ($params)?"$params":"";
			}
			//$param = ($params)?"?$params":"";
			fputs($socket, "{$method} /{$doc}{$getparam} HTTP/1.1\r\n");
			fputs($socket, "Host: {$this->host}\r\n");
			if($method == RestClient::POST or $method == RestClient::PUT){
				fputs($socket, "Content-type: application/x-www-form-urlencoded\r\n");
				fputs($socket, "Content-length: " . strlen($params) . "\r\n");
			}
			fputs($socket, "Connection: Close\r\n\r\n");
			if($method == RestClient::POST or $method == RestClient::PUT){
				fputs($socket, $params);
			}
			$res = $this->parseResult($socket);
			return $res;
		}
	}
	/*$rest_client = new RestClient("localhost");
	echo $rest_client->doRequest(RestClient::DELETE, "XML/REST/REST_VEZBA_6/service.php", array("c"=>"france"));6
	*/