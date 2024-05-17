<?php  
$link = mysqli_connect("localhost", "ilrexho", "xxxxxxxxxxxxxxxxxxxx", "albsale-vlora"); 
  
if ($link === false) { 
    die("ERROR: Could not connect. "
                .mysqli_connect_error()); 
} 
  
$sql = "SELECT * FROM Data"; 
if ($res = mysqli_query($link, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        echo "<table>"; 
        echo "<tr>"; 
        echo "<th>Firstname</th>"; 
        echo "<th>Lastname</th>"; 
        echo "<th>age</th>"; 
        echo "</tr>"; 
        while ($row = mysqli_fetch_array($res)) { 
            echo "<tr>"; 
            echo "<td>".$row['Firstname']."</td>"; 
            echo "<td>".$row['Lastname']."</td>"; 
            echo "<td>".$row['Age']."</td>"; 
            echo "</tr>"; 
        } 
        echo "</table>"; 
        mysqli_free_result($res); 
    } 
    else { 
        echo "No matching records are found."; 
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. "
                                .mysqli_error($link); 
} 
mysqli_close($link); 
?> 