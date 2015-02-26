<?php
	function visitor(){

		$nafn = $_GET['nafn'];
		$simi = $_GET['simi'];
		$email = $_GET['email'];
		$card = $_GET['card'];
		$card = md5($card);

		include("db.php");

		$sql = "INSERT INTO notendur (nafn,simi,email,kortanumer) VALUES ('$nafn','$simi','$email','$card')";

		$logon = $dbconnect->prepare($sql);

		$logon->execute();

	}
?>