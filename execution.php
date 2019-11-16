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

<body>

<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
$username = $_SESSION['username'];
?>

<div class="topcorner">
  <td><?php echo $username; ?></td>
</div> 

<img src="images/tuc.jpg" alt="TUC" style="width:150px;height:200px;">
<br>
<br>

<?php 
session_start();
$option = $_SESSION['option'];  // Teacher's option. Add || Edit || Delete || Search

$servername = "localhost";
$username = "eadmin";
$password = "manoloDB";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: ");
}

switch ($option) {    
	case 0:                                 // Add a New Student
		$std_id = $_POST['new_id'];
		$std_name = $_POST['new_name'];
		$std_surname = $_POST['new_surname'];
		$std_fname = $_POST['new_fname'];
		$std_grade = $_POST['new_grade'];
		$std_number = $_POST['new_number'];
		$std_date = $_POST['new_date'];

		$time = strtotime($std_date);    
		$newDateFormat = date('Y-m-d',$time);   // Turn date to form compatible to column data type
		$grade = floatval ($std_grade);         // Turn grade from string into float

		$sql = "INSERT INTO Students (id, name, surname, fathername, grade, mobileNumber, birthday)
		VALUES ('$std_id', '$std_name', '$std_surname', '$std_fname', $grade, '$std_number', '$newDateFormat')";

		if ($conn->query($sql) === TRUE) {
    		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('New Student inserted successfully');
    				window.location.href='Teacher.php';
    			  </script>");
		} else {
    		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Error.. Please try again..');
    				window.location.href='Teacher.php';
    			  </script>");
		}
		break;
	case 2:									 // Delete a Student
		$std_id = $_POST['delete_id'];
		$sql = "DELETE FROM Students WHERE id=$std_id";

		if ($conn->query($sql) === TRUE) {
    		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Student deleted successfully');
    				window.location.href='Teacher.php';
    			  </script>");
		} else {
    		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Error.. Please try again..');
    				window.location.href='Teacher.php';
    			  </script>");
		}
    
		break;
	case 3:								// Search for Students
		$condition = "";

		if (!empty($_POST['srch_id']))
			$cond .= " id={$_POST['srch_id']} AND";				// Add this info to total condition
		if (!empty($_POST['srch_name']))
			$cond .= " name='{$_POST['srch_name']}' AND";			
		if (!empty($_POST['srch_surname']))
			$cond .= " surname='{$_POST['srch_surname']}' AND";
		if (!empty($_POST['srch_fname']))
			$cond .= " fathername='{$_POST['srch_fname']}' AND";
		if (!empty($_POST['srch_number']))
			$cond .= " mobileNumber='{$_POST['srch_number']}' AND";
		if (!empty($_POST['srch_grade'])){
			$grade = floatval ($_POST['srch_grade']);         // Turn grade from string into float
			$cond .= " grade=$grade AND";
		}
		if (!empty($_POST['srch_date'])){
			$time = strtotime($_POST['srch_date']);    
		 	$newDateFormat = date('Y-m-d',$time);        // Turn date to form compatible to column data type
		 	$cond .= " birthday='$newDateFormat' AND";
		}

		$condition= preg_replace('/\W\w+\s*(\W*)$/', '$1', $cond);   // Remove last word -AND- of condition 

		$sql = "SELECT * FROM Students WHERE $condition";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "id: " . $row["id"] . " name: " .$row["name"] . ", surname: " . $row["surname"] . ", fathername: " .$row["fathername"] . ", grade: " . 
        		$row["grade"] . ", mobile Number: " .$row["mobileNumber"] . ", birthday: " . $row["birthday"] ;
        		echo "<br>";
    		}
		} else {
    		echo "No Student by these infos";
		}

		break;
	case 4:
		$std_id = $_POST['edit_id'];
		$_SESSION[‘old_id’] = $std_id;

		$sql = "SELECT * FROM Students WHERE id = $std_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
    			echo "Students Information";
        		echo "<br>" .  "id: " . $row["id"] . "<br>" . "name: " .$row["name"] . "<br>" .  "surname: " . $row["surname"] . "<br>" .  "fathername: " . 
        		$row["fathername"] . "<br>" .  "grade: " . $row["grade"] . "<br>" . "mobile Number: " .$row["mobileNumber"] . "<br>" .  "birthday: " . 
        		$row["birthday"] ;
        		echo "<br>";
    		}
		} else {
    		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('No student with this ID');
    				window.location.href='Teacher.php';
    			  </script>");
		}
?>
    <h3>Insert the changes here</h3>

    <?php $_SESSION['option'] = 5;  ?>
    <body>
    	<div>
  		<form action="execution.php" method="POST">
    		<label for="fname">ID</label>
    		<input type="text" id="id" name="chng_id">

    		<label for="lname">Name</label>
    		<input type="text" id="name" name="chng_name">

  			<label for="lname">Surname</label>
    		<input type="text" id="surname" name="chng_surname">  

    		<label for="lname">Father's Name</label>
    		<input type="text" id="fname" name="chng_fname">  

    		<label for="lname">Grade</label>
    		<input type="text" id="grade" name="chng_grade">

    		<label for="lname">Mobile Number</label>
    		<input type="text" id="number" name="chng_number">

    		<label for="lname">Birthday</label>
    		<input type="text" id="birthday" name="chng_date" placeholder="form yy/mm/dd ex. 1997/07/28">
  
    		<input type="submit" value="Make Changes">
  		</form>
		</div>
     </body>

<?php

		break;
	case 5:

	    $old_id = $_SESSION[‘old_id’]; 	

		if (!empty($_POST['chng_id'])){
			$new_id = $_POST['chng_id'];
			$sql = "UPDATE Students SET id = '$new_id' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			} 
		}
		if (!empty($_POST['chng_name'])){
			$new_name = $_POST['chng_name'];
			$sql = "UPDATE Students SET name = '$new_name' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		} 
		if (!empty($_POST['chng_surname'])){
			$new_surname = $_POST['chng_surname'];
			$sql = "UPDATE Students SET surname = '$new_surname' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		}
		if (!empty($_POST['chng_fname'])){
			$new_fname = $_POST['chng_fname'];
			$sql = "UPDATE Students SET fathername = '$new_fname' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		}
		if (!empty($_POST['chng_grade'])){
			$new_grade =  floatval ($_POST['chng_grade']);         // Turn grade from string into float
			$sql = "UPDATE Students SET grade = '$new_grade' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		}
		if (!empty($_POST['chng_number'])){
			$new_number = $_POST['chng_number'];         // Turn grade from string into float
			$sql = "UPDATE Students SET mobileNumber = '$new_number' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		}
		if (!empty($_POST['chng_date'])){
			$time = strtotime($_POST['chng_date']);    
		 	$newDateFormat = date('Y-m-d',$time);        // Turn date to form compatible to column data type
			$sql = "UPDATE Students SET birthday = '$newDateFormat' WHERE id = '$old_id' ";
		    if ($conn->query($sql) === FALSE) {
    			echo ("<script LANGUAGE='JavaScript'>
    				window.alert('Some Error occurred! Please try again..');
    				window.location.href='EditStudent.php';
    			  </script>");
			}
		}

		echo ("<script LANGUAGE='JavaScript'>
    				window.alert('successfully Updated');
    				window.location.href='Teacher.php';
    			  </script>");

		break;
	default:
		# code...
		break;
}


$conn->close();
?>	

</body>

</html>
