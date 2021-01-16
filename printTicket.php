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
	$num_t=$_SESSION['numOfP'];   // contains number of seats to be booked
	//$mode=$_SESSION['modeOfTravel'];
	$pnrSess=$_SESSION['currPnr'];
	$sql="SELECT * FROM `dbmsproject`.`bookinghistory` as B WHERE B.pnr='$pnrSess';";
	$res=$con->query($sql);
	$row = $res->fetch_assoc();
	$a=$row['train_num'];
	$b=$row['date_of_j'];
	$names=[];
	$ages=[];
	$genders=[];
	$seat_type=[];
	$coach_num=[];
	$berth_num=[];
	//echo $a;
	if($row['mode_travel']=="AC"){
		$sql1="SELECT * FROM `dbmsproject`.`traininfo` as T WHERE T.TNo='$a' and T.date_of_running='$b';";
		$res1=$con->query($sql1);
		if(!$res1) echo $con->error;
		$row1 = $res1->fetch_assoc();
		//echo $res1;
		$seats_t=$row1['booked_ac']-$num_t ; //booked seats so far
	

		for($i=0;$i<$num_t;$i++){
			$seats_t ++ ;
			if(($seats_t % 18)!=0){
				$num = (int)($seats_t/18) + 1;
				array_push($coach_num,$num);
			}
			else{
				$num = ($seats_t/18) ;
				array_push($coach_num,$num);
			}
			if($seats_t %6 ==1 || $seats_t %6 ==2){
				array_push($seat_type,"LB");
			}
			else if($seats_t %6 ==3 || $seats_t %6 ==4){
				array_push($seat_type,"UB");
			}
			else if($seats_t %6 ==5 ){
				array_push($seat_type,"SL");
			}
			else {
				array_push($seat_type,"SU");
			}

			$berth_nn;
			if($seats_t % 18 ==0){
				$berth_nn=18 ;
				array_push($berth_num,$berth_nn);

			}
else if($seats_t % 18 ==1){
$berth_nn= 1 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==2){
$berth_nn= 2 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==3){
$berth_nn= 3 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==4){
$berth_nn= 4 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==5){
$berth_nn= 5 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==6){
$berth_nn= 6 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==7){
$berth_nn= 7 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==8){
$berth_nn= 8 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==9){
$berth_nn= 9 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==10){
$berth_nn= 10 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==11){
$berth_nn= 11 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==12){
$berth_nn= 12;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==13){
$berth_nn= 13 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==14){
$berth_nn= 14 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==15){
$berth_nn= 15 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==16){
$berth_nn= 16 ;
array_push($berth_num,$berth_nn);

}
else {
$berth_nn= 17 ;
array_push($berth_num,$berth_nn);

}
		}
	}
	else{
		$sql2="SELECT * FROM `dbmsproject`.`traininfo` as T where T.TNo='$a' and T.date_of_running='$b';";
		$res2=$con->query($sql2);
		$row2 = $res2->fetch_assoc();
		//echo $res1;
		$seats_t=$row2['booked_sl']-$num_t ;
		for($i=0;$i<$num_t;$i++){
			$seats_t ++ ;
			if(($seats_t % 24)!=0){
				$num = (int)($seats_t/24) + 1;
				array_push($coach_num,$num);
			}
			else{
				$num = ($seats_t/24) ;
				array_push($coach_num,$num);
			}
			if($seats_t %8 ==1){
				array_push($seat_type,"LB");
			}
			else if($seats_t %8 ==2){
				array_push($seat_type,"MB");
			}
			else if($seats_t %8 ==3){
				array_push($seat_type,"UB");
			}
			else if($seats_t %8 ==4){
				array_push($seat_type,"LB");
			}
			else if($seats_t %8 ==5 ){
				array_push($seat_type,"MB");
			}
			else if($seats_t %8 ==6){
				array_push($seat_type,"UB");
			}
			else if($seats_t %8 ==7){
				array_push($seat_type,"SL");
			}
			else {
				array_push($seat_type,"SU");
			}

			$berth_nn;
if($seats_t % 24 ==0){
$berth_nn=24 ;
array_push($berth_num,$berth_nn);


}
else if($seats_t % 24 ==1){
$berth_nn= 1 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==2){
$berth_nn= 2 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==3){
$berth_nn= 3 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==4){
$berth_nn= 4 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==5){
$berth_nn= 5 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==6){
$berth_nn= 6 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==7){
$berth_nn= 7 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==8){
$berth_nn= 8 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==9){
$berth_nn= 9 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==10){
$berth_nn= 10 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==11){
$berth_nn= 11 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==12){
$berth_nn= 12;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 18 ==13){
$berth_nn= 13 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==14){
$berth_nn= 14 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==15){
$berth_nn= 15 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==16){
$berth_nn= 16 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==17){
$berth_nn= 17 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==18){
$berth_nn= 18 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==19){
$berth_nn= 19 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==20){
$berth_nn= 20 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==21){
$berth_nn= 21 ;
array_push($berth_num,$berth_nn);

}
else if($seats_t % 24 ==22){
$berth_nn= 22 ;
array_push($berth_num,$berth_nn);

}
else {
$berth_nn= 23 ;
array_push($berth_num,$berth_nn);

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
		<h1>Congratulations! Your ticket has been booked successfully.</h1><br>
	</div>	
	
	<div id="pticket">
		<p class="pt">PNR Number:<?php echo $_SESSION['currPnr'];?></p>
		<p class="pt">Agent Id:<?php echo $_SESSION['AgentName'];?></p>
		<p class="pt">Journey Details:</p>
		<p class="pt">Train Number:<?php echo $row['train_num'];?></p>
		<p class="pt">Date of Journey:<?php echo $row['date_of_j'];?></p>
		<p class="pt">Seats booked:<?php echo $num_t;?></p>
		<p class="pt">Coach Type:<?php echo $row['mode_travel'];?></p>	
		<table class="table">
  		<tr scope="row">
    			<th>S.No.</th>
			<th>Name</th>
    			<th>Age</th>
			<th>Gender</th>
			<th>Coach Number</th>
    			<th>Berth Number</th>
			<th>Berth Type</th>
  		</tr>
		<?php for($i=0;$i<$num_t;$i++){?>
  		<tr scope="row">
  		  	<td><?php echo $i+1;?></td>
  			<td><?php echo $_SESSION['namesSess'][$i];?></td>
  	  		<td><?php echo $_SESSION['agesSess'][$i];?></td>
			<td><?php echo $_SESSION['genSess'][$i];?></td>
			<td><?php echo $coach_num[$i];?></td>
  	  		<td><?php echo $berth_num[$i];?></td>
			<td><?php echo $seat_type[$i];?></td>
  		</tr>
  		<?php } ?>
		</table
	</div>	 
</div>
<script src="db1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>