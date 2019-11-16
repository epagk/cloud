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
    die("Connection failed: " . $conn->connect_error);
}

switch ($option) {    
	case 0:
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
	case 2:
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
	case 3:
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

		echo "Condition by now is: " . $condition;
		echo "<br>";

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

		#$std_date = $_POST['srch_date'];

		#$time = strtotime($std_date);    
		#$newDateFormat = date('Y-m-d',$time);   // Turn date to form compatible to column data type
		#$grade = floatval ($std_grade);         // Turn grade from string into float
		

		break;
	default:
		# code...
		break;
}

$conn->close();

?>	

</body>

</html>
