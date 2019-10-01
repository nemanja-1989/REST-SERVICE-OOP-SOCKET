<?php

	require_once "../service.php";
	
	class MovieRestService extends RestService{
		public function doGET($params){}
		public function doPOST($params){
			$mysqli = new mysqli("localhost", "root", "", "movies_maric_rest");
			$query = "INSERT INTO `movies` (`title`, `released`) VALUES
			('{$params["title"]}', '{$params["year"]}')";
			$mysqli->query($query);
		}
		public function doPUT($params){
			$mysqli = new mysqli("localhost", "root", "", "movies_maric_rest");
			$query = "UPDATE `movies` SET title='{$params['title']}', released='{$params['year']}' WHERE id={$params['id']}";
			$mysqli->query($query);
			echo "UPDATE `movies` SET title='{$params['title']}', released='{$params['year']}' WHERE id={$params['id']}";
		}
		public function doDELETE($params){}
	}
	$rest_service = new MovieRestService();
	$rest_service->handle();