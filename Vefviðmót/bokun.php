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

$retainnumberofguests = null;
$retainroomtype = null;
$retainhotelstadur = null;
$retainkomutimi = null;
$retainbrottfarartimi = null;
if (isset($_GET['visitors'])) {
	$retainnumberofguests = $_GET['visitors'];
	$retainroomtype = $_GET['roomtype'];
	$retainhotelstadur = $_GET['hotelstadur'];
	$retainkomutimi = $_GET['hallo'];
	$retainbrottfarartimi = $_GET['bless'];
	$numberofguests = $_GET['visitors'];
	$roomtype = $_GET['roomtype'];
	$hotelstadur = $_GET['hotelstadur'];
	$komutimi = $_GET['hallo'];
	$brottfarartimi = $_GET['bless'];
	// Create connection
	$conn = new mysqli("localhost", "root", "", "hotel");
	// Check connection
	if ($conn->connect_error) {
	     die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "
	SELECT herbergi.ID, tegund.tegund, tegund.nott 
	FROM herbergi 
	INNER JOIN tegund ON herbergi.tegundID = tegund.ID
	WHERE herbergi.hotelID = $hotelstadur 
	AND herbergi.tegundID = $roomtype 
	AND tegund.fjoldi >= $numberofguests 
	AND NOT EXISTS (
	    SELECT 1
	    FROM   bokanir
	    WHERE  bokanir.herbergiID = rooms.roomID
	    AND    bokanir.hallo < $brottfarartimi
	    AND    bokanir.bless > $komutimi
	)";
	$result = $conn->query($sql);

	if ($result->num_rows >= 1) {
	     // output data of each row
	     while($row = $result->fetch_assoc()) {
	         echo "<br> ID: ". $row["herbergi.ID"]. " - Tegund: ". $row["tegund.tegund"]. " Verð: " . $row["tegund.nott"] . "<br>";
	     }
	} else {
	     echo "0 results";
	}
	$conn->close();
}


if (isset($_GET['bokasimi'])) {
	
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
				  <option value="1">Hótel Stykkishólmur</option>
				  <option value="2">Hótel Ísafjörður</option>
				  <option value="3">Hótel Blönduós</option>
				  <option value="4">Hótel Sauðárkrókur</option>
				  <option value="5">Hótel Akureyri</option>
				  <option value="6">Hótel Húsavík</option>
				  <option value="7">Hótel Egilsstaðir</option>
				  <option value="8">Hótel Selfoss</option>
				  <option value="9">Hótel Vestmanneyjar</option>
				  <option value="10">Hótel Reykjavík</option>
				</select>
				<label for="hallo">Komutími</label>
				<input type="date" name="hallo" class="bokaitem form-control" value="<?php echo $retainkomutimi; ?>">
				<label for="bless">Brottför</label>
				<input type="date" name="bless" class="bokaitem form-control" value="<?php echo $retainbrottfarartimi; ?>">
				<button type="submit" class="formitem btn btn-default">Sjá möguleg herbergi</button>
			</div>
		</form>
		<div class="formheader">Skrá herbergi á gest</div>
		<form method="get" action="bokun.php" class="form-group">
			<label for="bokasimi">Símanúmer fyrir bókun</label>
			<input type="text" name="bokasimi" class="bokaitem form-control">
			<label for="bokahotel">Staðsetning Hótels</label>
				<select name="bokahotel" class="bokaitem form-control">
					<option value="1">Hótel Stykkishólmur</option>
					<option value="2">Hótel Ísafjörður</option>
					<option value="3">Hótel Blönduós</option>
					<option value="4">Hótel Sauðárkrókur</option>
					<option value="5">Hótel Akureyri</option>
					<option value="6">Hótel Húsavík</option>
					<option value="7">Hótel Egilsstaðir</option>
					<option value="8">Hótel Selfoss</option>
					<option value="9">Hótel Vestmanneyjar</option>
					<option value="10">Hótel Reykjavík</option>
				</select>
			<label for="bokasimi">Einkennisnúmer herbergis</label>
			<input type="text" name="bokasimi" class="bokaitem form-control" placeholder="Einkennisnúmer herbergis">
			<label for="arrival">Komutími</label>
			<input type="date" name="arrival" class="bokaitem form-control">
			<label for="going">Brottför</label>
			<input type="date" name="going" class="bokaitem form-control">
		</form>
	</div>
</body>
</html>