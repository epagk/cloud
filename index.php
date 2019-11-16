<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body background="images/backImage.jpg">

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
  <h3>A web site about human resources management<br>of Technical University of Crete</h3>
</div> 
<br><br>

<div id="form">
	<form action="validation.php" method="POST">
		<p>
			<label>Username</label>
			<input type="text" id="user" name="user" required />
		</p>
		<p>
			<label>Password</label>
			<input type="password" id="pass" name="pass" required />
		</p>
		<p>
			<input type="submit" id="btn" value="Login" />
		</p>
	</form> 
</div>

</body>	

</html>
