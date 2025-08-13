<?php
$servername = "localhost";
$username = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$password = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
$dbname = "xxxxxxxxxxxxxxx";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $saltcode = $_POST['saltcode'];
    $title = $_POST['title'];
    $quantity = $_POST['quantity'];
    $priceperunit = $_POST['priceperunit'];
    $currency = $_POST['currency'];
    
    $unit = $_POST['unit'];
    $ZINN = 'I09345R'; // Hardcoded ZINN for this example
    $stock = $_POST['stock'];
    $stock = $stock - $quantity;

    if ($stock < 0) {
        echo "Fehler: Die Menge übersteigt den verfügbaren Bestand.";
    } else {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Insert into salesorder table
            $value = $quantity * $priceperunit;
            $stmt = $conn->prepare("INSERT INTO salesorder (ZINN, saltcode, title, quantity, unit, value, currency) VALUES (?, ?, ?, ?, ?, ?, ?)");
            // Corrected bind_param method with proper data types: 's' for string, 'i' for integer, 'd' for double
            $stmt->bind_param("sssssds", $ZINN, $saltcode, $title, $quantity, $unit, $value, $currency);

            if ($stmt->execute()) {
                // Update stock in salt table
                $stmt = $conn->prepare("UPDATE salt SET stock = ? WHERE saltcode = ?");
                $stmt->bind_param("ds", $stock, $saltcode);
                
                if ($stmt->execute()) {
                    // Commit transaction
                    $conn->commit();
                    echo "Kundensauftrag erfolgreich aufgegeben.";
                } else {
                    // Rollback transaction
                    $conn->rollback();
                    echo "Error: " . $stmt->error;
                }
            } else {
                // Rollback transaction
                $conn->rollback();
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            // Rollback transaction
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
}

// ******************************************************************************
// Prepare data for SAP Cloud Integration
$salesOrderData = array(
    "saltcode" => $saltcode,
    "title" => $title,
    "quantity" => $quantity,
    "unit" => "Ton",
    "value" => $value,
    "currency" => "EU"
);

// Convert data to JSON
$jsonData = json_encode($salesOrderData);

// Define the SAP Cloud Integration endpoint
$sapCloudIntegrationUrl = "https://355554d9trial.it-cpitrial06-rt.cfapps.us10-001.hana.ondemand.com/http/receiveSalesOrder";

// Encode the credentials for Basic Authentication
$username = 'sb-dc841ez47-c429-4260-9284-64f44faa6ce4!b287713|it-rt-355554d9trial!b55215';
$password = 'x7cdcfe9b-3c39-4162-aacf-baa7d519daf8$x2Ek7N_NIA7OsVj0jE2iDEOHbKWFJWXzYDwOa2-9PBM=';
$auth = base64_encode("$username:$password");

// Send data to SAP Cloud Integration
$ch = curl_init($sapCloudIntegrationUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . $auth
));

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close the connection
curl_close($ch);

// Check response status
if ($httpCode == 200) {
    echo "und Daten wurden an SAP Cloud Integration gesendet.";
} else {
    echo ", aber Daten konnten nicht an SAP Cloud Integration gesendet werden. Antwortcode:" . $httpCode;
   // echo "Error: " . $sql . "<br>" . $conn->error;
}

// The end of data posting towards Integration Flow

$conn->close();
?>

