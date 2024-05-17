<html>
<head>
<title>Benutzer Registration</title>
<link rel="stylesheet" href="css/stili.css" />
</head>
<body>
<center><br />
<img src="image/logo.png" id="img1" />
<h2>Geben Sie ihre Details ein:</h2>
<img src="image/vlora01.jpg" width="450" />
<br /><br />
<form action="register.php" method="POST" id="forma">
<br /><br />
Name*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" /><br /><br />
Nachname*:&nbsp;&nbsp;&nbsp;<input type="text" name="surname" /><br /><br />
ZINN Kod*:&nbsp;&nbsp;&nbsp;<input type="text" name="ZINN" required /><br /><br />
E-Mail*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" required /><br /><br />
Telephone:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tel" /><br /><br /><br />
<input type="submit" value="Register" id="button" />
</form>

<?php
// initiieren wir die Verbindung mit der Datenbank
$link = mysqli_connect("localhost", "ilrexho", "xxxxxxxxxxxxxxxxxxxxxxxx", "albsale-vlora"); 
  
if ($link === false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 

// Überprüfen wir, ob die Variablen deklariert sind und ihnen ein Wert zugewiesen wird
if    (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['ZINN']) && isset($_POST['email']) && isset($_POST['tel']))
{

	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$ZINN=$_POST['ZINN'];
	$email=$_POST['email'];
	$tel=$_POST['tel'];
	// $Insert=true;

	// Der Fragebogen ist vorbereitet
	$query = "INSERT INTO user (name, surname, ZINN, email, tel)
    VALUES ('$name','$surname','$ZINN','$email','$tel')";

	// Der Fragebogen ist aktiviert
	$rezult = mysqli_query($link, $query);

	// Das Ergebnis wird in der DB überprüft
	if (!$rezult) {
		die('<font color="red">Bei der Registrierung ist ein Fehler aufgetreten $query:</font>'.mysqli_error());
	}

		// mysql_query($query);
		echo '<font color="red">Benutzer erfolgreich hinzugefügt</font>';

	 // Die Verbindung zur MySQ-Datenbank wird geschlossenL
	 mysqli_close($link);
}
?>
<br />
<p>ACHTUNG: Mit * gekennzeichnete Optionen sind Pflichtfelder</p>
<h3><a href="index.php">Zurück zur Startseite</a></h3>
<h3><a href="saltsearch.php">Klicken Sie hier, um nach einem Artikel zu suchen</a></h3>
<br /> &copy; Copyright <b>:: RealCore Group GmbH</b> 2024
</center>
</body>
</html>