<?php
require 'databaseconn.php';
if($_POST)
$add=$_POST['search'];
$query ="SELECT min(Loc1) as ml1,max(Loc1) as ml2,min(Loc2)as nl1,max(Loc2) as nl2 FROM `my_information` WHERE Address LIKE '%$add%' AND Status='0'"; 
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
echo json_encode($row);
mysqli_close($conn);

?>