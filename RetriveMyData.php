<?php
include 'databaseconn.php';
$func=$_POST["Operation"];
if ($func=='getMapData') {
$sql = "SELECT `Srn`,`Loc1`,`Loc2`,`Type`,`Description` FROM `my_information` WHERE 1";
	
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	
	while($row = mysqli_fetch_array($res)){
    array_push($result,
    array('Srn'=>$row[0],
    'loc1'=>$row[1],
    'loc2'=>$row[2],
    'type'=>$row[3]
  ));
}
	
	echo json_encode(array("response"=>$result));
}
else if ($func=='getMyComplaints1') {
	$Srn=$_POST["Srn"];
	$sql = "SELECT `Srn`,`Loc1`,`Loc2`,`Type`,`Address`,`D_Report`,`D_Solved`,`Status` FROM `my_information` WHERE `Srn`='$Srn'";
	
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	
	while($row = mysqli_fetch_array($res)){
    array_push($result,
    array('Srn'=>$row[0],
    'Loc1'=>$row[1],
    'Loc2'=>$row[2],
    'Type'=>$row[3],
    'Address'=>$row[4],
    'D_Report'=>$row[5],
    'D_Solved'=>$row[6],
    'Status'=>$row[7]
  ));
}
	
	echo json_encode(array("response"=>$result));
}
else if ($func=='getMyComplaints1') {
	$encoded_string = $_POST["encoded_string"];
	$i=0;	
$Srn=json_decode($encoded_string, true);
while ( $i<count($Srn["my"])) {
$v= $Srn["my"][$i];
$p="SELECT `Srn`,`Loc1`,`Loc2`,`Type`,`Description` FROM `my_information` WHERE `Srn`='$v'";
if($c=mysqli_query($conn,$p)){
	$rows[$i]  = mysqli_fetch_assoc($c);
}
$i=$i+1;
}
echo json_encode(array("response"=>$rows));
}
?>	