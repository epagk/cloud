<!DOCTYPE html>
<html>
<head>
	<title>Validation Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body background="images/backImage.jpg"
>
<div class="header">
  <h2>TUC Web Page</h2>
</div> 

<address id="addr">
Technical University of Crete<br>    <!-- Introduce Tuc -->
Visit us at: <a href="https://www.tuc.gr" target="_blank">TUC</a>
<br>
Kounoupidiana, Crete<br>
Greece
</address> 


<div id="intro">
  <h3>A web site about human resources managements<br>of Technical University of Crete</h3>
</div> 
<br><br>	
</body>

<?php
session_start();
// Get values
$username = $_POST['user']; 
$password = $_POST['pass'];

$username = stripcslashes($username);
$password = stripcslashes($password);

// Create connection
$conn = mysqli_connect("localhost", "eadmin", "manoloDB", "myDB");

// Check connection
if (!$conn) {
    die("Failed to connect database: " . $conn->connect_error);
}

// Search in database for user
$sql = "SELECT * FROM Teachers WHERE username='$username' AND password='$password' ";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
if ($row['username'] == $username && $row['password'] == $password) {
	$_SESSION['username'] = $username;
	header("Location:Teacher.php");
} else {
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Wrong Username or Password');
    window.location.href='index.php';
    </script>");
}

?>

</html>
