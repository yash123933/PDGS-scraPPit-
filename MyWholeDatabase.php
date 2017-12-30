<?php
require 'databaseconn.php';
$sq = "SELECT  `Srn` ,  `D_Report` ,  `D_Solved` ,  `Loc1` ,  `Loc2` ,  `Address` ,  `Status` ,  `Count` FROM  `my_information` WHERE Status='0'";
$result = mysqli_query($conn, $sq);
$result1 = array();
while ($row = mysqli_fetch_assoc($result)){
array_push($result1,
    array('Srn'=>$row['Srn'],
    'D_Report'=>$row['D_Report'],
    'D_Solved'=>$row['D_Solved'],
    'Loc1'=>$row['Loc1'],
    'Loc2'=>$row['Loc2'],
    'Address'=>$row['Address'],
    'Status'=>$row['Status'],
    'Count'=>$row['Count']
  ));
}
echo json_encode(array("response"=>$result1));
?>