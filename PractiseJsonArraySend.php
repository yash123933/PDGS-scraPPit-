<?php
include 'databaseconn.php';
$encoded_string=$_POST["encoded_string"];
//echo $encoded_string;
$i=0;	
$Srn=json_decode($encoded_string,true);
while ( $i<count($Srn["my"])) {
$v= $Srn["my"][$i];
$p="SELECT `Srn`,`Count`,`D_Report`,`D_Solved`,`Address`,`Status`,`Image1`,`Image2` FROM `my_information` WHERE `Srn`='$v'";
if($c=mysqli_query($conn,$p)){
	$rows[$i]  = mysqli_fetch_assoc($c);
}
$i=$i+1;
}
echo date("Y-m-d")."&";
echo json_encode(array("response"=>$rows));
//echo json_encode($rows);
?>