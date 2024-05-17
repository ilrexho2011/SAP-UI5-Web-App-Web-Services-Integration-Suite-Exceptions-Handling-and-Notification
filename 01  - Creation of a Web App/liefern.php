
<html>
<head>
<title>Lieferformular</title>
  <link rel="stylesheet" href="css/stili.css" />
</head>
<body>
<center><br />
<img src="image/logo.png" id="img1" />
<h2>Lieferformular</h2>
<img src="image/albsale03.jpg" width="450" />
<br /><br />
    <form method="post" id="forma" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Geben Sie ihre Details ein:</h2>
        Salzcode: * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="saltcode"><br /><br />
        Titel:/* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title"><br /><br />
        Hersteller:/* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="producer"><br /><br />
        Menge: * &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="quantity"><br /><br />
        Preis pro Einheit:/* <input type="text" name="priceperunit"><br /><br />
        <input type="submit" value="Einreichen" id="button" />
    </form>
    <br />
    <?php
// Database connection parameters
$servername = "localhost";
$username = "ilrexho";
$password = "xxxxxxxxxxxxxxxxxx";
$dbname = "albsale-vlora";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $saltcode = $_POST['saltcode'];
    $title = $_POST['title'];
    $producer = $_POST['producer'];
    $quantity = $_POST['quantity'];
    $priceperunit = $_POST['priceperunit'];

    // Check if saltcode already exists
    $check_sql = "SELECT * FROM salt WHERE saltcode = '$saltcode'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Saltcode exists, update stock
        $row = $result->fetch_assoc();
        $stock = $row['stock'] + $quantity;
        $unit = $row['unit'];
        $currency = $row['currency'];

        // Update stock in salt table
        $update_sql = "UPDATE salt SET stock = '$stock' WHERE saltcode = '$saltcode'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<font color='red'>Lagerbestand entsprechend aktualisiert!<br></font>";
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    } else {
        // Saltcode doesn't exist, insert new record
        $unit = 'Ton'; // Default unit
        $currency = 'EU'; // Default currency
        $stock = $quantity; // Default stock value

        // Insert new record into salt table
        $insert_sql = "INSERT INTO salt (saltcode, title, producer, stock, unit, priceperunit, currency) 
                       VALUES ('$saltcode', '$title', '$producer', '$stock', '$unit', '$priceperunit', '$currency')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "<font color='red'>Neu Artikel erfolgreich  eingefügt!</font><br>";
        } else {
            echo "<font color='red'>Fehler beim Einfügen des Artikels: </font>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<p>ACHTUNG: Mit * gekennzeichnete Optionen sind Pflichtfelder</p>
<h3><a href="index.php">Zurück zur Startseite</a></h3>
<h3><a href="saltsearch.php">Klicken Sie hier, um nach einem Artikel zu suchen</a></h3>
<br /> &copy; Copyright <b>:: RealCore Group GmbH</b> 2024
</center>
</body>
</html>