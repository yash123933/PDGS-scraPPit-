<?php
//include 'databaseconn.php';
//$func=$_POST["Operation"];
//if ($func=='getMapData') 
{
//$sql = "SELECT `Srn`,`Loc1`,`Loc2`,`Type`,`Description` FROM `my_information` WHERE 1";
	
//	$res = mysqli_query($conn,$sql);
	//$response=array();
	$result1 = array();
	$result2 = array();
	//while($row = mysqli_fetch_array($res)){
    array_push($result1,
    array('name'=>"yash",
    'type'=>"yash0",
    'loc1'=>"yash1",
    'loc2'=>"yash3"
  ));
    array_push($result2,
    array(
    'solvedP'=>"5",
    'unsolvedP'=>"6",
    'solvedS'=>"8",
    'unsolvedS'=>"2"
    ));
    
}
	$final = array();
	$a1=(array("response1"=>$result1));
	$a2=(array("response2"=>$result2));
	array_push($final,$a1);
	array_push($final,$a2);
	echo json_encode(array("final"=>$final));
?>