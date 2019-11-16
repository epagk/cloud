<!DOCTYPE html>
<html>
<head>
	<title>Teacher Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<style>
body  {
  background-image: url("images/blueFade.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}
</style>

</head>

<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
$username = $_SESSION['username'];
?>

<body>
	
<div class="topcorner">
  <td><?php echo $username; ?></td>
</div> 

<img src="images/tuc.jpg" alt="TUC" style="width:150px;height:200px;">
<br>
<br>

<header>
	<div class="container">

	<nav>
		<ul>
			<li><a href="AddStudent.php">Add</a></li>
			<li><a href="EditStudent.php">Edit</a></li>
			<li><a href="DeleteStudent.php">Delete</a></li>
			<li><a href="SearchStudent.php">Search</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	</nav>
    </div>
</header>
<br>

<img src="images/pyrinas.jpg" alt="TUC" class="center" style="width:600px">

</body>

</html>
