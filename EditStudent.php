<!DOCTYPE html>
<html>
<head>
	<title>Edit Student Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<style>
body  {
  background-image: url("images/blueFade.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>

</head>

<?php
session_start();
$_SESSION['option'] = 4; // 4 is for Finding the Student we want to edit
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

<div class="option">
  <h2>Edit Students</h2>
</div>
<br> 

<h3>Insert ID of the Student you want to edit</h3>

<div>
  <form action="execution.php" method="POST">
    <label for="fname">ID</label>
    <input type="text" id="id" name="edit_id" required>

    <input type="submit" value="Edit Student">
  </form>
</div>
<br>

</body>

</html>
