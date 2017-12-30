<?php
 header('Content-type : bitmap; charset=utf-8');
 include 'databaseconn.php';
 $func=$_POST["Operation"];
        $Srn=$_POST["Srn"];
	$encoded_string = $_POST["encoded_string"];
	$image_name = $_POST["image_name"];
	$decoded_string = base64_decode($encoded_string);
	$path = "images/".$image_name.".jpeg";
	if($func=='insertInformation'){
		$query="SELECT `Count` FROM `my_information` WHERE `Image1`='' AND `Srn`='$Srn'";
		$result = mysqli_query($conn, $query) ;
		if (mysqli_num_rows($result) == 1) 
                {
                file_put_contents($path, $decoded_string);
		//$row = mysqli_fetch_assoc($result);
		//$Srn=$row["Srn"];
		$query = "UPDATE `my_information` SET `Image1`='$path' WHERE `Srn`= '$Srn'";
		$result = mysqli_query($conn, $query) ;
		if($result){
			echo "success";
		}else{
			echo "failed";
		}
		}
}
	else if ($func=='onupdate') {
		$Srn=$_POST["Srn"];
		$query = "UPDATE `my_information` SET `Image2`='$path',`Status`='1' WHERE `Srn`= '$Srn'";
		$result = mysqli_query($conn, $query) ;
		if($result){
			echo "success";
		}else{
			echo "failed";
		}
	}
		
		mysqli_close($conn);
	

?>