<?php
require 'databaseconn.php';
if($_POST['search'])
$add=$_POST['search'];
if($add=="")
$add="India";
$sq = "SELECT `Srn` FROM  `my_information` WHERE  `Status` =  '0' AND  `Srn` LIKE  '1%' AND `Address` LIKE  '%$add%' ";
$result = mysqli_query($conn, $sq);
$pothole_Unsolved=mysqli_num_rows($result);
$sq = "SELECT `Srn` FROM  `my_information` WHERE  `Status` =  '1' AND  `Srn` LIKE  '1%' AND `Address` LIKE  '%$add%' ";
$result = mysqli_query($conn, $sq);
$pothole_solved=mysqli_num_rows($result);
$sq = "SELECT `Srn` FROM  `my_information` WHERE  `Status` =  '0' AND  `Srn` LIKE  '2%' AND `Address` LIKE  '%$add%'";
$result = mysqli_query($conn, $sq);
$sanitization_Unsolved=mysqli_num_rows($result);
$sq = "SELECT `Srn` FROM  `my_information` WHERE  `Status` =  '1' AND  `Srn` LIKE  '2%' AND `Address` LIKE  '%$add%'";
$result = mysqli_query($conn, $sq);
$sanitization_solved=mysqli_num_rows($result);
$result1 = array();
array_push($result1,
    array('pothole_Unsolved'=>$pothole_Unsolved,
    'pothole_solved'=>$pothole_solved,
    'sanitization_Unsolved'=>$sanitization_Unsolved,
    'sanitization_solved'=>$sanitization_solved
   ));
echo json_encode(array("response"=>$result1));
?>