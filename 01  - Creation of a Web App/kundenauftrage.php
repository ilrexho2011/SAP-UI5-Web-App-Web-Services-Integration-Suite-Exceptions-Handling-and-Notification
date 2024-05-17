<html>
<head>
<title>Sales Order @ Albsale-Vlora</title>
<link rel="stylesheet" href="css/stili.css" />
</head>

<body>
<center><br />
<img src="image/logo.png" id="img1" />
<h2>Liste der Kundenaufträge</h2>
<img src="image/albsale01.jpg" width="650" />
<br /><br />
<?php
$link = mysqli_connect("localhost", "ilrexho", "--------------------", "albsale-vlora"); 
  
if ($link === false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
}

    $sql ="SELECT * FROM salesorder";
    $sql2 ="SELECT * FROM salt";
	$res = mysqli_query($link, $sql);
    $res2 = mysqli_query($link, $sql2);

if (!$res) {
	die('<font color="red">Gabim i ndodhur ne pyetesorin $sql:</font>'.mysqli_error());
} else if(!$res2) {
	die('<font color="red">Gabim i ndodhur ne pyetesorin $sql:</font>'.mysqli_error());
} else {
          echo"<table class='table1'>";
          echo "<tr>
                    <th><b>Nr:</br></th>
                    <th><b>ZINN:</b></th>
                    <th><b>Salzcode:</b></th>
                    
                    <th><b>Menge:</b></th>
                    <th><b>Einheit:</b></th>
                    <th><b>Wert:</b></th>
                    <th><b>Währung:</b></th>
                </tr>";
            $i=0;
            // $data2 = mysqli_fetch_array($res2);
            while ($data = mysqli_fetch_array($res))
                {
                    echo "<tr>
                            <td><i>".++$i.".</i></td>
                            <td>". $data['ZINN']."</td>
                            <td>". $data['saltcode']."</td>
                            
                            <td>". $data['quantity']."</td>
                            <td>". $data['unit']."</td>
                            <td>". $data['value']."</td>
                            <td>". $data['currency']."</td>
                          </tr>";
                }
            echo"</table>";
        }
    mysqli_close($link);
?>
<br />
<font face="TimesNewRoman" color="blue">
<h3><a href="index.php">Zurück zur Startseite</a></h3>
<h3><a href="salesorder.php">Klicken Sie hier, um Artikel zu bestellen</a></h3>
</font>
&copy; Copyright <b>:: RealCore Group GmbH</b> 2024
</center>
</body>
</html>