<?php
$servername = "localhost";
$username = "root";
$password = "";
$myDB = "tutorial";

$conn = new mysqli($servername, $username, $password,$myDB);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}else{
    $sql = "SELECT * FROM student";
    $result = $conn ->query($sql);
    if($result->num_rows>0){
       while($row = $result->fetch_assoc()){
        echo "id: " . $row["id"]."firstName: ". $row["firstName"]. "lastName: ". $row["lastName"]. "<br>";
       }
    }else{
       echo "Failed to delete the record";
    }
}



$conn -> close();




?>