<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: bokun.php");
}
if (isset($_POST['username'])) {

	include("db.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT salt, password, username FROM users WHERE username=:username LIMIT 1";

    $logon = $dbconnect->prepare($sql);

    $logon->bindParam(':username',$username);

    $logon->execute();

    $returnedData = $logon->fetch();

    $Blowfish_Pre = '$2a$05$';

    $Blowfish_End = '$';

    $salt = $returnedData['salt'];

    $dbUsername = $returnedData['username'];

    $dbPassword = $returnedData['password'];

    $hashpass = crypt($password, $Blowfish_Pre . $salt . $Blowfish_End);

    echo $salt;
    echo $dbUsername;
    echo $dbPassword;
    echo $hashpass;
    if ($hashpass == $dbPassword && $dbUsername == $username) {
      $_SESSION['username'] = $username;
      header("Location:bokun.php");
    }
    else{
      echo '<script type="text/javascript">alert("Rangt notendanafn eða lykilorð")</script>';
    }
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
	<link rel="stylesheet" type="text/css" href="css.css">
	<title>Generic Hótel</title>
</head>
<body>
	<header><span>Innskráning</span></header>
	<div class="pagewrapper">
		<form class="form-group" action="index.php" method="post">
			<input class="formitem form-control" type="text" name="username" placeholder="Notendanafn">
			<input class="formitem form-control" type="password" name="password" placeholder="Lykilorð">
			<button class="formitem btn btn-default" type="submit">Skrá inn</button>
		</form>
	</div>
</body>
</html>