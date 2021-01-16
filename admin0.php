 <?php
	$server="localhost";
	$username="root";
	$password="";
	$con=mysqli_connect($server,$username,$password);
	if(!$con){
		die("connection to this database failed due to".mysqli_connect_error());
	}
	//echo "Success connecting to the database<br>";
	$check=false;
	$flag1=false; //verification
		
	
	if(isset($_POST['uid']) && isset($_POST['upw']) && isset($_POST['button0'])){ 
            	$check=true;
        } 
	//echo $checkD;
	//echo $checkI;
	if($check==true){
		if($_POST['uid']=='gu@gmail.com' && $_POST['upw']=='gst123'){
			header('Refresh:0.5; URL= admin.php');
		} 
		else{
			$flag1=true;
		}
	}

	$con->close();

?>

<html>
<head>
<title>Railway Booking System</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<img class="bg" src="train3.jpg" alt="trainImage">
<nav class="navbar navbar-dark bg-dark">
<span class="navbar-text">
    Railways Management Portal 
</span>
	
	
</nav>
<div class="container">
	 
	<div id="ad0">
		<form action='admin0.php' method='post'>
			<div class="form-group">
				<label for="uid">Email Id</label>
  				<input type="email" id="ad01"  class="form-control" name="uid">
			</div>
			
			<div class="form-group">
				<label for="pword">Password</label>
				<input type="password" id="ad02" class="form-control" name="upw">
			</div>
			<br><center><button type='submit' name='button0' class='btn btn-dark'>Submit</button></center>
		</form>	
	</div>
	<?php
		if($flag1){
 			echo "<h2 id='error'>Failed to verify the admin</h2>";
		}		
	?>	 
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>