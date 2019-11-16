<!DOCTYPE html>
<html>
<head>
	<title>Add Student Page</title>
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
$_SESSION['option'] = 0; // 0 is for Add a Student
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
  <h2>Add New Student</h2>
</div>
<br> 

<div>
  <form action="execution.php" method="POST">
    <label for="fname">ID</label>
    <input type="text" id="id" name="new_id" required>

    <label for="lname">Name</label>
    <input type="text" id="name" name="new_name" required>

	<label for="lname">Surname</label>
    <input type="text" id="surname" name="new_surname" required>  

    <label for="lname">Father's Name</label>
    <input type="text" id="fname" name="new_fname" required>  

    <label for="lname">Grade</label>
    <input type="text" id="grade" name="new_grade" required>

    <label for="lname">Mobile Number</label>
    <input type="text" id="number" name="new_number" required>

    <label for="lname">Birthday</label>
    <input type="text" id="birthday" name="new_date" placeholder="form yy/mm/dd ex. 1997/07/28" required>
  
    <input type="submit" value="Add Student">
  </form>
</div>
<br>

</body>

</html>