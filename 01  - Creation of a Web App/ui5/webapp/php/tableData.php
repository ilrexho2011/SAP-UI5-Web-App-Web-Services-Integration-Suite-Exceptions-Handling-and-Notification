<?php 

$servername = "localhost";
$username = "ilrexho";
$password = "nA)Aj9NQWix0[diC";
$dbname = "albsale-vlora";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

 $sql = "select * from salt";
 
 $res = mysqli_query($conn,$sql);
 
 $result = array();
 
 while($row = mysqli_fetch_array($res)){
 array_push($result, 
 array('saltcode'=>$row[0],'title'=>$row[1],'producer'=>$row[2],'stock'=>$row[3], 'unit'=>$row[4], 'priceperunit'=>$row[5], 'currency'=>$row[6]));
 }
 
 echo json_encode(array('result'=>$result));
?>