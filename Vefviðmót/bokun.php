<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: index.php");
}
//þetta er til þess að taka inn nýjann gest
$retainname = null;
$retainsimi = null;
$retainemail = null;
$retaincard = null;
if (isset($_GET['nafn'])) {
	$retainname = $_GET['nafn'];
	$retainsimi = $_GET['simi'];
	$retainemail = $_GET['email'];
	$retaincard = $_GET['card'];
	require("visitor.php");
	visitor();
}
//þetta er til að velja laust herbergi
$selectedroom = null;
$retainnumberofguests = null;
$retainroomtype = null;
$retainhotelstadur = null;
$retainkomutimi = null;
$retainbrottfarartimi = null;
if (isset($_GET['visitors'])) {
	include("db.php");

	$numberofguests = $_GET['visitors'];
	$roomtype = $_GET['roomtype'];
	$hotelstadur = $_GET['hotelstadur'];
	$komutimi = $_GET['hallo'];
	$brottfarartimi = $_GET['bless'];

	$sql = "
	SELECT hotel.nafn, herbergi.ID, tegund.tegund, tegund.nott
	FROM herbergi
	INNER JOIN hotel ON herbergi.hotelID = hotel.ID
	INNER JOIN tegund ON herbergi.tegundID = tegund.ID
	WHERE herbergi.hotelID = $hotelstadur
	AND herbergi.tegundID = $roomtype
	AND tegund.fjoldi >= $numberofguests
	AND herbergi.ID NOT IN(
	SELECT herbergiID FROM bokanir
	WHERE hallo <= '$komutimi' AND bless >= '$brottfarartimi'
	)";

	$logon = $dbconnect->prepare($sql);

	$logon->execute();

	$returnedData = $logon->fetch();

	$hotelID = $returnedData['nafn'];

	$roomID = $returnedData['ID'];

    $RoomTegund = $returnedData['tegund'];

    $roomVerd = $returnedData['nott'];

    $selectedroom = "Herbergisnúmer: ".$roomID."| Herbergistegund: ".$RoomTegund."| Verð á nótt: ".$roomVerd."| Staðsetning Hótels: ".$hotelID;
}
//setur inn bókun fyrir viðskiptavin
if (isset($_GET['bokasimi'])) {
	require("bokaroom.php");
	bookRoom();
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
	<div class="pagewrapper">
		<div class="formheader"><span>Skrá gest</span></div>
		<form method="get" action="bokun.php" class="form-group">
			<div class="usergroup">
				<label for="nafn">Fullt nafn</label>
				<input type="text" name="nafn" class="bokaitem form-control" placeholder="Fullt nafn" value="<?php echo $retainname; ?>">
				<label for="simi">Símanúmer</label>
				<input type="text" name="simi" class="bokaitem form-control" placeholder="Símanúmer" value="<?php echo $retainsimi; ?>">
				<label for="email">Tölvupóstfang</label>
				<input type="text" name="email" class="bokaitem form-control" placeholder="Tölvupóstfang" value="<?php echo $retainemail; ?>">
				<label for="card">Kortanúmer</label>
				<input type="text" name="card" class="bokaitem form-control" placeholder="Kortanúmer" value="<?php echo $retaincard; ?>">
				<button type="submit" class="formitem btn btn-default" >Setja inn gest</button>
			</div>
		</form>
		<div class="formheader"><span>Möguleg herbergi</span></div>
		<form method="get" action="bokun.php" class="form-group">
			<div class="eliminategroup">
				<label for="visitors">Fjöldi gesta</label>
				<input type="number" name="visitors" class="bokaitem form-control" placeholder="Fjöldi gesta" value="<?php echo $retainnumberofguests; ?>">
				<label for="roomtype">Tegund herbergis</label>
				<select name="roomtype" class="bokaitem form-control" value="<?php echo $retainroomtype; ?>">
				  <option value="1">Tjaldstæði</option>
				  <option value="2">Farfugl</option>
				  <option value="3">Kofi</option>
				  <option value="4">Einfalt</option>
				  <option value="5">Svíta</option>
				  <option value="6">Forsetasvíta</option>
				</select>
				<label for="hotelstadur">Staðsetning Hótels</label>
				<select name="hotelstadur" class="bokaitem form-control" value="<?php echo $retainhotelstadur; ?>">
				  <option value="0">Hótel Stykkishólmur</option>
				  <option value="1">Hótel Ísafjörður</option>
				  <option value="2">Hótel Blönduós</option>
				  <option value="3">Hótel Sauðárkrókur</option>
				  <option value="4">Hótel Akureyri</option>
				  <option value="5">Hótel Húsavík</option>
				  <option value="6">Hótel Egilsstaðir</option>
				  <option value="7">Hótel Selfoss</option>
				  <option value="8">Hótel Vestmanneyjar</option>
				  <option value="9">Hótel Reykjavík</option>
				</select>
				<label for="hallo">Komutími</label>
				<input type="date" name="hallo" class="bokaitem form-control" value="<?php echo $retainkomutimi; ?>">
				<label for="bless">Brottför</label>
				<input type="date" name="bless" class="bokaitem form-control" value="<?php echo $retainbrottfarartimi; ?>">
				<button type="submit" class="formitem btn btn-default">Sjá möguleg herbergi</button>
			</div>
		</form>
		<div class="herbergi">
			<?php echo $selectedroom; ?>
		</div>
		<div class="formheader">Skrá herbergi á gest</div>
		<form method="get" action="bokun.php" class="form-group">
			<label for="bokasimi">Símanúmer fyrir bókun</label>
			<input type="text" name="bokasimi" class="bokaitem form-control">
			<label for="bokaherb">Einkennisnúmer herbergis</label>
			<input type="text" name="bokaherb" class="bokaitem form-control" placeholder="Einkennisnúmer herbergis">
			<label for="arrival">Komutími</label>
			<input type="date" name="arrival" class="bokaitem form-control">
			<label for="going">Brottför</label>
			<input type="date" name="going" class="bokaitem form-control">
			<button type="submit" class="formitem btn btn-default">Bóka Herbergi</button>
		</form>
		<div class="formheader">Annarskonar skipanir</div>
		<form method="get" action="bokun.php" class="form-group">
			<label for="query">Hér fer SQL skipunin</label>
			<textarea name="query" class="form-control" cols="30" rows="10"></textarea>
		</form>
	</div>
</body>
</html>
