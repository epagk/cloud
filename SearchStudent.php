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
$_SESSION['option'] = 3; // 3 is for Searching a Student
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
  <h2>Search a Student</h2>
</div>
<br> 

<h3>Insert some information about Students</h3>

<div>
  <form action="execution.php" method="POST">
    <label for="fname">ID</label>
    <input type="text" id="id" name="srch_id">

    <label for="lname">Name</label>
    <input type="text" id="name" name="srch_name">

  <label for="lname">Surname</label>
    <input type="text" id="surname" name="srch_surname">  

    <label for="lname">Father's Name</label>
    <input type="text" id="fname" name="srch_fname">  

    <label for="lname">Grade</label>
    <input type="text" id="grade" name="srch_grade">

    <label for="lname">Mobile Number</label>
    <input type="text" id="number" name="srch_number">

    <label for="lname">Birthday</label>
    <input type="text" id="birthday" name="srch_date" placeholder="form yy/mm/dd ex. 1997/07/28">
  
    <input type="submit" value="Search Student">
  </form>
</div>
<br>

</body>

</html>
