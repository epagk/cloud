<?php
$servername = "localhost";
$username = "eadmin";
$password = "manoloDB";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

//ALTER TABLE Students
//MODIFY COLUMN grade FLOAT(6,4); 

$sql = "UPDATE Students SET grade=10 WHERE id=0112";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


mysqli_close($conn);
?>
