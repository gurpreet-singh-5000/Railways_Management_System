 <?php
	$server="localhost";
	$username="root";
	$password="";
	$con=mysqli_connect($server,$username,$password);
	if(!$con){
		die("connection to this database failed due to".mysqli_connect_error());
	}
	//echo "Success connecting to the database<br>";
	$checkI=false;
	$checkD=false;
	$flag1=false; //fail insert
	$flag2=false; // fail delete
	$flag3=false; //succ insert
	$flag4=false; //succ delete
	if(isset($_POST['tnum']) && isset($_POST['tname']) && isset($_POST['dateT']) && isset($_POST['fromC']) && isset($_POST['toC'])&& isset($_POST['num_ac']) && isset($_POST['num_sl'])
	&& isset($_POST['buttonA'])){ 
            	$checkI=true;
        } 	
	if($checkI==true){
		$tnuma=$_POST['tnum'];
		$tnamea=$_POST['tname'];
		$dateta=$_POST['dateT'];
		$fromca=$_POST['fromC'];
		$toca=$_POST['toC'];
		$numaa=$_POST['num_ac'];
		$numsa=$_POST['num_sl'];
		$sql1="SELECT `TNo`, `date_of_running` FROM `dbmsproject`.`traininfo` as dt WHERE dt.TNo='$tnuma' and dt.date_of_running='$dateta';";
		$res1=$con->query($sql1);
		if($res1->num_rows==0){
			$init=0;
			$sql2="INSERT INTO `dbmsproject`.`traininfo`(`TNo`, `TName`, `FromCity`, `ToCity`, `date_of_running`, `num_ac`, `booked_ac`, `num_sl`, `booked_sl`)
	 		VALUES ('$tnuma','$tnamea','$fromca','$toca','$dateta','$numaa','$init','$numsa','$init');";
			$res2=$con->query($sql2);
			$flag3=true;
		}
		else $flag1=true;
	}
	if(isset($_POST['tnum2']) && isset($_POST['dateT2']) && isset($_POST['buttonA2'])){ 
            	$checkD=true;
        } 
	//echo $checkD;
	//echo $checkI;
	if($checkD==true){
		$tnuma2=$_POST['tnum2'];
		$dateta2=$_POST['dateT2'];
		$sql1="SELECT `TNo`, `date_of_running` FROM `dbmsproject`.`traininfo` as dt WHERE dt.TNo='$tnuma2' and dt.date_of_running='$dateta2';";
		$res1=$con->query($sql1);
		if($res1->num_rows==1){
			$sql2="DELETE FROM `dbmsproject`.`traininfo` WHERE TNo='$tnuma2' and date_of_running='$dateta2';";
			$res2=$con->query($sql2);
			if($res2) $flag4=true;
			else $con->error;
		}
		else $flag2=true;
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
	
	<button class="btn btn-dark" id="n1" onclick="showI()">Add Trains</button>
	<button class="btn btn-dark" id="n2" onclick="showD()">Remove Trains</button>
	
</nav>
<div class="container">
	<?php
		if($flag1){
 			echo "<h2 id='error'>Train number ".$_POST['tnum']." already exists on ".$_POST['dateT']."</h2>";
			header("Refresh:2");
		}
		if($flag2){ 
			echo "<h2 id='error'>Train number ".$_POST['tnum2']." is not running on ".$_POST['dateT2']."</h2>";
			header("Refresh:2");
		}
		if($flag3){ 
			echo "<h2 id='succ'>Train number ".$_POST['tnum']." added successfully on ".$_POST['dateT']."</h2>";
			header("Refresh:2");
		}
		if($flag4) {
			echo "<h2 id='succ'>Train number ".$_POST['tnum2']." deleted successfully from ".$_POST['dateT2']."</h2>";
			header("Refresh:2");
		}
		
	?>			
	<div id="ad1">
		<form action='admin.php' method='post'>
			<div class="form-group">
				<label for="tnum">Train Number</label>
  				<input type="text" id="ad11"  class="form-control" name="tnum">
			</div>
			<div class="form-group">
				<label for="tname">Train Name</label>
				<input type="text" id="ad12" class="form-control" name="tname">
			</div>
			<div class="form-group">
				<label for="fromC">From</label>
				<input type="text" id="ad13" class="form-control" placeholder="Enter city name" name="fromC">
			</div>
			<div class="form-group">
				<label for="toC">To</label>
				<input type="text" id="ad14" class="form-control" placeholder="Enter city name" name="toC">
			</div>
			<div class="form-group">
				<label for="dateT">Date of Journey</label>
				<input type="date" id="ad15" class="form-control" name="dateT">
			</div>
			<div class="form-group">
				<label for="num_ac">Number of AC coaches</label>
				<input type="number" id="ad16" class="form-control" name="num_ac">
			</div>
			<div class="form-group">
				<label for="num_sl">Number of SL coaches</label>
				<input type="number" id="ad17" class="form-control" name="num_sl">
			</div>
			<br><center><button type='submit' name='buttonA' class='btn btn-dark'>Submit</button></center>
		</form>	
	</div>	 
	<div id="ad2">
		<form action='admin.php' method='post'>
			<div class="form-group">
				<label for="tnum2">Train Number</label>
  				<input type="text" id="ad21"  class="form-control" name="tnum2">
			</div>
			
			<div class="form-group">
				<label for="dateT2">Date of Journey</label>
				<input type="date" id="ad22" class="form-control" name="dateT2">
			</div>
			<br><center><button type='submit' name='buttonA2' class='btn btn-dark'>Submit</button></center>
		</form>	
	</div>	 
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>