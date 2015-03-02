<?php
	function bookRoom(){
		
	$simanumer = $_GET['bokasimi'];
	$roomnumber = $_GET['bokaherb'];
	$hotelnumber = $_GET['bokahotel'];
	$arrivaldate = $_GET['arrival'];
	$leavingdate = $_GET['going'];

	include("db.php");

	$sql = "INSERT INTO bokanir (notandiID, hotelID, herbergiID, hallo, bless)
	VALUES ((SELECT ID FROM notendur WHERE simi = $simanumer), '$hotelnumber', '$roomnumber','$arrivaldate', '$leavingdate')";

	$logon = $dbconnect->prepare($sql);

	$logon->execute();
	}
?>