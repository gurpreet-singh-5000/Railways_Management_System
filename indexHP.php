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
	$checkT=false;
	//$x=$_POST['baIdL'];
	//echo $x;
	session_start(); 
    	$agentid = $_SESSION['AgentName'];
	//echo $myVar;
	$checkTSuccess=true;
	$checkTSucc=false;
	date_default_timezone_set("Asia/Kolkata");
	$currTime=date("Y-m-d").date("h:i:s");
        if(isset($_POST['num']) && isset($_POST['tnum']) && isset($_POST['dateT']) && isset($_POST['mode']) && isset($_POST['buttonT'])){ 
            	$checkT=true;
        } 
	if($checkT){
		$seatsA=false;
		$numT=$_POST['num']; // num of passengers
		$tnumT=$_POST['tnum'];  // train no
		$dateTT=$_POST['dateT']; //year-month-date
		$modeT=$_POST['mode'];
		/////
		if($dateTT<date("Y-m-d")) $seatsA=false;
		else{
		if($modeT=="SL"){
			$sql="SELECT `num_sl`, `booked_sl` FROM `dbmsproject`.`traininfo` as T WHERE T.TNo='$tnumT' and T.date_of_running='$dateTT' and T.booked_sl+$numT<=T.num_sl*24;";
			$res;
			if($res=$con->query($sql)){
			 	if($res->num_rows==1){
					 $seatsA=true; 
					 $sql1="UPDATE `dbmsproject`.`traininfo` SET `dbmsproject`.`traininfo`.booked_sl = `dbmsproject`.`traininfo`.booked_sl+$numT  WHERE `dbmsproject`.`traininfo`.TNo='$tnumT' and `dbmsproject`.`traininfo`.date_of_running='$dateTT' ;";
					 $res1;
					 $res1=$con->query($sql1);
				}
				else $checkTSuccess=false;
			}
			else echo "Error<br> $con->error";
		}
		else{
			$sql="SELECT `num_ac`, `booked_ac` FROM `dbmsproject`.`traininfo` as T WHERE T.TNo='$tnumT' and T.date_of_running='$dateTT' and T.booked_ac+$numT<=T.num_ac*18;";
			$res;
			if($res=$con->query($sql)){
			 	if($res->num_rows==1){
					$seatsA=true; 
					$sql1="UPDATE `dbmsproject`.`traininfo` SET `dbmsproject`.`traininfo`.booked_ac = `dbmsproject`.`traininfo`.booked_ac+$numT  WHERE `dbmsproject`.`traininfo`.TNo='$tnumT' and `dbmsproject`.`traininfo`.date_of_running='$dateTT' ;";
					 $res1;
					 $res1=$con->query($sql1);
				}
				else $checkTSuccess=false;
			}
			else echo "Error<br> $con->error";
		}
		}
		/////
		if($seatsA){
				//$checkTSucc=true;
			//$pnr=time();
			$d_value_new= date("Y/m/d") ;

			$year_value_new=substr($d_value_new, 0, 4);

			$month_value_new=substr($d_value_new, 5, 2);

			$day_value_new=substr($d_value_new, 8, 2);

			$t_value_new=date("H:i:s");

			$h_value_new=substr($t_value_new, 0, 2);

			$min_value_new=substr($t_value_new, 3, 2);

			$sec_value_new=substr($t_value_new, 6, 2);


			$pnr=$year_value_new.$month_value_new.$day_value_new.$h_value_new.$min_value_new.$sec_value_new;
			
			$sql="INSERT INTO `dbmsproject`.`bookinghistory`(`pnr`, `agent_id`, `num_of_pass`, `date_of_j`,`b_time`, `train_num`, `mode_travel`)
			 VALUES ('$pnr','$agentid','$numT','$dateTT','$currTime','$tnumT','$modeT');";		
			$res=$con->query($sql);
			$_SESSION['currPnr']=$pnr;
			$_SESSION['numOfP']=$numT;
			$_SESSION['modeOfTravel']=$modeT;
			header('Refresh:0.5; URL= ticket.php');
		}
		else{
			$checkTSuccess=false;
			//echo "fail";
		}
	}

	$sqlbh="SELECT * FROM `dbmsproject`.`bookinghistory` AS B WHERE B.agent_id='$agentid' ";
	$resbh=$con->query($sqlbh);
	$pnrarr=[];
	$dojarr=[];
	$tnoarr=[];
	$btimearr=[];
	$numparr=[];
	$cotype=[];
	while($rowsbh=$resbh->fetch_assoc()){
		array_push($pnrarr,$rowsbh['pnr']);
		array_push($dojarr,$rowsbh['date_of_j']);
		array_push($tnoarr,$rowsbh['train_num']);
		array_push($btimearr,$rowsbh['b_time']);
		array_push($numparr,$rowsbh['num_of_pass']);
		array_push($cotype,$rowsbh['mode_travel']);
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
    Tickets Booking Portal 
</span>
	<button class="btn btn-dark"  onclick="showB()">Book Tickets</button>
	<button class="btn btn-dark"  onclick="showH()">View Booking History</button>
	<span class="navbar-text">
    		<?php echo $agentid;?> 
	</span>
</nav>
<div class="container">

	<div id="c2">
		<form action="indexHP.php" method="post">
		<div class="form-group">
			<label for="num">Enter number of passengers:</label>
  			<input type="text" id="c21"  class="form-control" name="num">
		</div>
		<div class="form-group">
			<label for="tnum">Enter train number:</label>
			<input type="text" id="c22" class="form-control" name="tnum">
		</div>
		<div class="form-group">
			<label for="dateT">Enter date of journey:</label>
			<input type="date" id="c23" class="form-control" name="dateT">
		</div>
		<div class="form-group">
			<label for="mode">Select mode of travel:</label>
			<select name="mode" class="form-control" id="c24">
  				<option value="AC">AC</option>
  				<option value="SL">SL</option>
			</select>
		</div>
		<center><button type="submit" name="buttonT" class="btn btn-dark">Submit</button></center>
		</form>
		
	</div>
	<?php
	if(!$checkTSuccess){
		echo "<h2 id='error'>Unable to book tickets!</h2>";
		header("Refresh:4");
	}
	?>

	<div id="bh">
		<table class="table">
  		<tr scope="row">
    			<th>S.No.</th>
			<th>PNR Number</th>
    			<th>Train Number</th>
			<th>Date of Journey</th>
			<th>Booking Time</th>
    			<th>Number of Passengers</th>
			<th>Coach Type</th>
  		</tr>
		<?php   $num_t=$resbh->num_rows;
			if($num_t==0){
				 echo "<h2 id='error'>Booking history is empty.</h2>";
				//header("Refresh:4");
			}
			else{
			for($i=0;$i<$num_t;$i++){?>
  		<tr scope="row">
  		  	<td><?php echo $i+1;?></td>
  			<td><?php echo $pnrarr[$i];?></td>
  	  		<td><?php echo $tnoarr[$i];?></td>
			<td><?php echo $dojarr[$i];?></td>
			<td><?php echo $btimearr[$i];?></td>
  	  		<td><?php echo $numparr[$i];?></td>
			<td><?php echo $cotype[$i];?></td>
  		</tr>
  		<?php }	} ?>
		</table

	</div>
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>