<?php
session_start();
error_reporting(0);
include 'databaseconn.php';

 if($_POST)
{
$_SESSION['u']="2";
$type=$_POST["type"];
$sla=$_POST["sla"];
if($type=="1")
$p="pothole";
else
$p="garbage";

$sq="UPDATE `SLA` SET `sla`='$sla' WHERE `type`='$type' ";
if(mysqli_query($conn,$sq))
	$p=2;
echo "<script>alert('SLA Changed Successfully');</script>";
}

header('location:admin.php');
?>