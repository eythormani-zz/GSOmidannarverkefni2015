<?php


if (isset($_POST['username'])) {


	//ini_set("display_errors","1");
	//ERROR_REPORTING(E_ALL);
	CRYPT_BLOWFISH or die ('No Blowfish found.');

	include("db.php");

	$password = $_POST['password'];
	$username = $_POST['username'];

	//This string tells crypt to use blowfish for 5 rounds.
	$Blowfish_Pre = '$2a$05$';
	$Blowfish_End = '$';

	$Allowed_Chars =
	'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
	$Chars_Len = 63;

	// 18 would be secure as well.
	$Salt_Length = 21;
	$salt = "";

	for($i=0; $i<$Salt_Length; $i++)
	{
	    $salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
	}
	$bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;

	$hashed_password = crypt($password, $bcrypt_salt);

	$sql = 'INSERT INTO users (username, salt, password) ' .
	  "VALUES ('$username', '$salt', '$hashed_password')";
	      
	$logon = $dbconnect->prepare($sql);

	$logon->execute();

}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Create Users</title>
</head>
<body>
	<form class="form-group" method="post" action="createuser.php">
		<input class="form-control" type="text" name="username" id="username" placeholder="Notendanafn">
		<input class="form-control" type="password" name="password" id="password" placeholder="Lykilorð">
		<button class="btn btn-default" type="submit">Skapa	Notenda</button>
	</form>
</body>
</html>