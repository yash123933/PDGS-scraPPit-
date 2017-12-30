<?php
if($_POST){
require 'databaseconn.php';
$srn=$_POST['Srn'];
$Q="SELECT Count FROM `my_information` WHERE Srn='$srn'  AND `Status`='0' ";
$result = mysqli_query($conn, $Q);
$row = mysqli_fetch_assoc($result);
$Count=$row['Count'];
$Count++;
$sq="UPDATE `my_information` SET `Count`='$Count' WHERE  `Srn`='$srn'"; 
if(mysqli_query($conn, $sq))
echo "v";
mysqli_close($conn);
}
?>