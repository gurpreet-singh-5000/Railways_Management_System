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
	session_start();
	$_SESSION['namesSess'] = array();
	$_SESSION['agesSess'] = array();
	$_SESSION['genSess'] = array();

	$x=$_SESSION['numOfP'];
	?>
	<script type="text/javascript">	
		var num = <?php echo $x ?>;
	</script>
	<?php

	
	$names=[];
	$ages=[];
	$genders=[];
	//for($j=0;$j<$x;$j++){
		//if(isset($_POST['pn'.$j]) && isset($_POST['pa'.$j]) && isset($_POST['pg'.$j]) && isset($_POST['buttonT'])){
		///	array_push($names,$_POST['pn'.$j]);
		//	array_push($ages,$_POST['pa'.$j]);
		//	array_push($genders,$_POST['pg'.$j]);
			//echo $names[$j];		
	//}
	$checkU=false;
	for($j=0;$j<$x;$j++){
		if(isset($_POST['pass_names'][$j]) && isset($_POST['pass_ages'][$j]) && isset($_POST['pass_gen'][$j])&& isset($_POST['buttonT'])){
			array_push($names,$_POST['pass_names'][$j]);
			array_push($ages,$_POST['pass_ages'][$j]);
			array_push($genders,$_POST['pass_gen'][$j]);
			array_push($_SESSION['namesSess'],$names[$j]);
			array_push($_SESSION['agesSess'],$ages[$j]);
			array_push($_SESSION['genSess'],$genders[$j]);
			//echo "yes";
			//echo $names[$j];
			$checkU=true;
		}
		//
	}
	//if(isset($_POST['p1n']['0'])) echo $_POST['p1n']['0'];
	if($checkU) header('Refresh:0.5; URL= printTicket.php');
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
		<h1>Enter details of the passengers</h1><br>
	</div>	
	<div id="ticket2">
		<form action="ticket.php" method="post">
		<?php	for($i=0;$i<$x;$i++){	?>
			<div id="per">
			<label>Enter details:</label>
  			<input type="text" placeholder="Name" name="pass_names[]">
			<input type="number" placeholder="Age" name="pass_ages[]">
			<select name="pass_gen[]">
  				<option value="M">Male</option>
  				<option value="F">Female</option>
				<option value="Not Specified">Do not want to specify</option>
			</select>
			</div>
			 
		<?php } ?>
		<br><center><button type="submit" name="buttonT" class="btn btn-dark">Print Ticket</button></center>
		</form>	
	</div>
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>