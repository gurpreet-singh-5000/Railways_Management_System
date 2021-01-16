<?php
	$server="localhost";
	$username="root";
	$password="";
	$con=mysqli_connect($server,$username,$password);
	if(!$con){
		die("connection to this database failed due to".mysqli_connect_error());
	}
	//echo "Success connecting to the database<br>";

	$sql;
	$signIn=false;
	$logIn=false;
	$checkS=true;
	$logInF=false;
	$signInF=false;
	$signInSuccess=false;
	//
        if(isset($_POST['baIdL']) && isset($_POST['baPL']) && isset($_POST['buttonL'])) { 
        	$logIn=true;
        } 
        if(isset($_POST['baIdS']) && isset($_POST['baPS']) && isset($_POST['buttonS']) && isset($_POST['baNS']) && isset($_POST['baAS']) && isset($_POST['baCS'])) { 
            	$signIn=true;
        } 
    	//	
	if($logIn){
		$baidl=$_POST['baIdL'];
		$bapl=$_POST['baPL'];
		//echo "Done <br>";
		$sql="SELECT `Id`, `Password` FROM `dbmsproject`.`bookingagent` as B WHERE B.Id='$baidl' and B.Password='$bapl';";
		$res=$con->query($sql);
		if($res->num_rows==1){
			//echo "Successfully Inserted<br>";
			session_start(); 
    			$_SESSION['AgentName'] = $baidl;
			 header('Refresh:0.5; URL= indexHP.php');
		}
		//else echo "Error<br> $con->error";
		else $logInF=true;
	}
	if($signIn){	
		$baids=$_POST['baIdS'];
		$baps=$_POST['baPS'];
		$bans=$_POST['baNS'];
		$bacs=$_POST['baCS'];
		$baas=$_POST['baAS'];
	
		if($checkS){
		//('Name', 'CreditCardN', 'Address', 'Id', 'Password')
			$sql="SELECT * FROM `dbmsproject`.`bookingagent` as B WHERE B.Id='$baids';";
			$res=$con->query($sql);
			if($res->num_rows==1) $signInF=true;
			else{
				$sql="INSERT INTO `dbmsproject`.`bookingagent`(`Name`, `CreditCardN`, `Address`, `Id`, `Password`) VALUES ('$bans','$bacs','$baas','$baids','$baps');";
				if($con->query($sql)){
					$signInSuccess=true;
				}
				else echo "Error<br> $con->error";
			}
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
<div class="container">
	<div id="c1">
		<h1>Welcome to the Booking Portal</h1><br>
	</div>
	<div id="bac1">
		<center><button class="btn btn-dark" onclick="showL()">Log In</button>
		<button class="btn btn-dark" onclick="showS()">New User? Sign In</button></center>
	</div>
	<div id="bac2">
		<form action="index.php" method="post">
  		<div class="form-group">
  			<label for="baIdL">Email address</label>
    			<input type="email" class="form-control" id="baIdL" name="baIdL" aria-describedby="emailHelp">
  		</div>
  		<div class="form-group">
    			<label for="baPL">Password</label>
    			<input type="password" name="baPL" class="form-control" id="baPL">
  		</div>
		<center><button type="submit" class="btn btn-dark" name="buttonL">Submit</button></center>
		</form>
	</div>
	<div id="bac3">
		<form action="index.php" method="post">
  		<div class="form-group">
  			<label for="baIdS">Email address</label>
    			<input type="email" class="form-control" name="baIdS" id="baIdS" aria-describedby="emailHelp">
  		</div>
  		<div class="form-group">
    			<label for="baPS">Password</label>
    			<input type="password" class="form-control" id="baPS" name="baPS">
  		</div>
		<div class="form-group">
  			<label for="baNS">Name</label>
    			<input type="text" class="form-control" id="baNS" name="baNS" aria-describedby="emailHelp">
  		</div>
		<div class="form-group">
    			<label for="baCS">Credit Card Number</label>
    			<input type="text" class="form-control" id="baCS" name="baCS">
  		</div>
		<div class="form-group">
    			<label for="baAS">Address</label>
    			<input type="text" class="form-control" id="baAS" name="baAS">
  		</div>
  		<center><button type="submit" name="buttonS" class="btn btn-dark">Submit</button></center>
	
		</form>
	</div>
	<?php
			if($logInF){
				 echo "<h2 id='error'>Either username or password is incorrect.</h2>";
				header("Refresh:4");
			}
			if($signInF){
				 echo "<h2 id='error'>The username already exists.</h2>";
				header("Refresh:4");
			}
			if($signInSuccess){
				 echo "<h2 id='succ'>Successfully registered as new booking agent.</h2>";
				header("Refresh:4");
			}
		?>
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>