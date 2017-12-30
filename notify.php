<?php
if($_POST)
{
require 'databaseconn.php';
$add=$_POST['search'];

$query ="SELECT Status,D_Report FROM `my_information` WHERE Srn='$add'"; 
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
echo $row['Status']."a";
echo $row['D_Report']."b";
$query ="SELECT sla FROM `SLA` WHERE type='$add[0]'"; 
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
echo $row['sla'];
mysqli_close($conn);
}
?>