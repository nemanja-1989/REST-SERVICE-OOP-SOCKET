<?php
	class RestService{
		const GET = "GET";
		const POST = "POST";
		const PUT = "PUT";
		const DELETE = "DELETE";
		public function check_method(){
			$method = strtolower($_SERVER["REQUEST_METHOD"]);
			switch($method){
				case "get":
					return RestService::GET;
				break;
				case "post":
					return RestService::POST;
				break;
				case "put":
					return RestService::PUT;
				break;
				case "delete":
					return RestService::DELETE;
				break;
			}
		}
		public function handle(){
			$method = $this->check_method();
			switch($method){
				case RestService::GET:
					$this->doGET($_GET);
				break;
				case RestService::POST:
					$this->doPOST($_POST);
				break;
				case RestService::PUT:
					$body = file_get_contents("php://input");
					//echo $body;
					$body = explode("&", $body);
					$params = array();
					foreach($body as $param){
						$param = explode("=", $param);
						$key = $param[0];
						$value = $param[1];
						$params[$key] = $value;
					}
					$this->doPUT($params);
				break;
				case RestService::DELETE:
					$this->doDELETE($_GET);
				break;
			}
		}
		public function doGET($params){}
		public function doPOST($params){}
		public function doPUT($params){}
		public function doDELETE($params){}
		
	}
	class MyRestService extends RestService{
		public function doGET($params){
			global $arr;
			if(isset($params["c"])){
				print_r($arr[$params["c"]]);
			}else{
				print_r($arr);
			}
		}
		public function doPOST($params){
			global $arr;
			$arr[$params["c"]] = $params["ct"];
			print_r($arr);
		}
		public function doPUT($params){
			global $arr;
			$arr[$params["c"]] = $params["ct"];
			print_r($arr);
		}
		public function doDELETE($params){
			global $arr;
			unset($arr[$params["c"]]);
			print_r($arr);
		}
	}
	/*$arr = array(
		"england"=>"london",
		"france"=>"paris"
	);
	$rest_service = new MyRestService();
	$rest_service->handle();
	*/