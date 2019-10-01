<?php
	require_once "client.php";
	if(isset($_POST["insert"]))
	{
		$title = $_POST["title"];
		$year = $_POST["year"];
		$rest_client = new RestClient("localhost");
		echo $rest_client->doRequest(RestClient::POST, "XML/REST/REST_VEZBA_6/movies/index.php", array(
			"title"=>$title,
			"year"=>$year
		));
	}
	
	if(isset($_POST["update"]))
	{
		$title = $_POST["title"];
		$year = $_POST["year"];
		$rest_client = new RestClient("localhost");
		echo $rest_client->doRequest(RestClient::PUT, "XML/REST/REST_VEZBA_6/movies/index.php", array(
			"title"=>$title,
			"year"=>$year,
			"id"=>1
		));
	}
?>
<form action="" method="POST">
	<select name="id" onchange="if(this.value == -1) return; window.location='?mid='+this.value">
		<option value="-1">Select movie</option>
	</select><br>
	<input type="text" name="title" placeholder="Title"><br>
	<input type="text" name="year" placeholder="Released year"><br>
	<input type="submit" name="insert" value="Insert">
	<input type="submit" name="update" value="Edit">
	<input type="submit" name="delete" value="Delete">
</form>