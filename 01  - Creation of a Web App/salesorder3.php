<html>
<head>
  <title>Sales Order Form</title>
  <link rel="stylesheet" href="css/stili.css" />
</head>
<body>
<center><br />
<img src="image/logo.png" id="img1" />
<h2>Bestellformular</h2>
<img src="image/albsale02.jpg" width="450" />
<br /><br />

<?php
// We have this database connection parameters
$servername = "localhost";
$username = "ilrexho";
$password = "xxxxxxxxxxxxxxxxxxxxxx";
$dbname = "albsale-vlora";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "user" table
$query = "SELECT * FROM `user`";
$result = mysqli_query($conn, $query);

// Check if data was retrieved successfully
if ($result) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error fetching data from database: " . mysqli_error($conn);
    // Handle the error appropriately, such as exiting the script or showing an error message
}

// Fetch ZINNS for dropdown
$sql_ZINNS = "SELECT ZINN FROM user";
$result_ZINNS = $conn->query($sql_ZINNS);
$ZINNS = array();
if ($result_ZINNS->num_rows > 0) {
  while ($row = $result_ZINNS->fetch_assoc()) {
    $ZINNS[] = $row['ZINN'];
  }
}

// Fetch saltcodes for dropdown
$sql_saltcodes = "SELECT saltcode FROM salt";
$result_saltcodes = $conn->query($sql_saltcodes);
$saltcodes = array();
if ($result_saltcodes->num_rows > 0) {
  while ($row = $result_saltcodes->fetch_assoc()) {
    $saltcodes[] = $row['saltcode'];
  }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $ZINNS_selected = $_POST['ZINN'];
  $saltcodes_selected = $_POST['saltcode'];
  $quantity = $_POST['quantity'];
  

  // Loop through selected ZINNS
  foreach ($ZINNS_selected as $ZINN) {

  // Loop through selected saltcodes
  foreach ($saltcodes_selected as $saltcode) {
    // Calculate value from salt table
    $sql_get_price = "SELECT priceperunit FROM salt WHERE saltcode = $saltcode";
    $result_price = $conn->query($sql_get_price);
    if ($result_price->num_rows > 0) {
      $row_price = $result_price->fetch_assoc();
      $priceperunit = $row_price["priceperunit"];
      $value = $priceperunit * $quantity;

      // Insert into salesorder table
      $sql_insert = "INSERT INTO salesorder (ZINN, saltcode, title, quantity, unit, value, currency)
                     SELECT '$ZINN', '$saltcode', title, '$quantity', 'Ton', '$value', 'EU' FROM salt WHERE saltcode = $saltcode";

      if ($conn->query($sql_insert) === TRUE) {
        // Update stock in salt table
        $sql_update_stock = "UPDATE salt SET stock = stock - $quantity WHERE saltcode = $saltcode";
        if ($conn->query($sql_update_stock) !== TRUE) {
          echo "Error updating stock: " . $conn->error;
        }
      } else {
        echo "Error inserting record: " . $conn->error;
      }
    } else {
      echo "Error: Saltcode not found.";
    }
  }
}

  echo "<font color='red'>Kundenauftrag erfolgreich eingefügt.</font>";
  $conn->close();
}
?>

<br /><br />
<form method="post" id="forma" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<h3>Geben Sie ihre Details ein:</h3>

<label for="ZINN">Wählen Kunde in Liste: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="ZINN[]" id="ZINN">
      <?php
        // Assuming $users is an array containing data from the 'user' table
        foreach ($users as $user) {
          echo "<option value='{$user['ZINN']}'>{$user['name']} {$user['surname']}</option>";
        }
      ?>
    </select><br /><br /><br />
    
    <label for="saltcode">Salz - Kod:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="saltcode[]" id="saltcode" width="150">
      <?php
        // Assuming $saltcodes is an array containing possible salt codes
        foreach ($saltcodes as $code) {
          echo "<option value='{$code}'>{$code}</option>";
        }
      ?>
    </select><br /><br />
   
    Menge:*(Ton) &nbsp;<input type="text" name="quantity"><br /><br /><br /><br />
    
    <input type="submit" value="Einreichen" id="button"><br />
  </form>

  <script>
    function toggleZINN() {
      var ZINNSelect = document.getElementById("ZINN");
      if (ZINNSelect.style.display === "none") {
        ZINNSelect.style.display = "block";
      } else {
        ZINNSelect.style.display = "none";
      }
    }

    function toggleSaltcode() {
      var saltcodeDropdown = document.getElementById("saltcode");
      if (saltcodeDropdown.style.display === "none") {
        saltcodeDropdown.style.display = "block";
      } else {
        saltcodeDropdown.style.display = "none";
      }
    }
  </script>

<p>ACHTUNG: Mit * gekennzeichnete Optionen sind Pflichtfelder</p>
<h3><a href="index.php">Zurück zur Startseite</a></h3>
<h3><a href="saltsearch.php">Klicken Sie hier, um nach einem Artikel zu suchen</a></h3>
<br /> &copy; Copyright :: <b>RealCore Group GmbH</b> 2024
</center>
</body>
</html>
