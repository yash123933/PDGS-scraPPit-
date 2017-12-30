<?php
require 'databaseconn.php';
$func=$_POST["Operation"];
if ($func=='insertInformation') 
{
   $l1= $Lat = $_POST["Loc1"];      
   $l2=$Long = $_POST["Loc2"];           
   $Type = $_POST["Type"];
   $Description=$_POST["Description"];
   $encoded_string = $_POST["encoded_string"];
   $image_name = $_POST["image_name"];
   $decoded_string = base64_decode($encoded_string);
   $path = "images/".$image_name.".jpeg";
   $upd=$Status=0;
   $D_Report=date("Y-m-d");
   $pinco=getAddress($Lat,$Long);       
   $y=explode( '**',$pinco );
   $pinco=$y[0];

   if($Type>'2')
      $query ="SELECT * FROM `my_information` WHERE Srn LIKE '%$pinco%'  AND `Status`='0' ";

   else
    {        
        $c=$Type.$pinco;
        $query ="SELECT * FROM `my_information` WHERE Srn LIKE '$c%'";
    }

   $result = mysqli_query($conn, $query);
   $n=mysqli_num_rows($result);
   if($n==0  && $Type<='2')
    {
        file_put_contents($path, $decoded_string);
        $Srn=$Type*10000000000+$pinco*10000;
        $sq = "INSERT INTO `my_information`(`Srn`, `D_Report`, `Count`, `Loc1`, `Loc2`, `Status`,`Address`,`Image1`) VALUES('$Srn','$D_Report','1','$Lat','$Long','$Status','$y[1]','$path')";      
    }
   else if($n>0)
    {   
        $min=10;
        while ($row = mysqli_fetch_assoc($result))
          {    
           if($row["Status"]==0)
           {      
            $x=distance($Lat,$Long,$row["Loc1"],$row["Loc2"]);
            if($x<$min)
              {             
                $Srn=$row["Srn"];
                if($Type==$Srn[0])
                  {             
                    $l1=$row["Loc1"];
                    $l2=$row["Loc2"];        
                    $D_Report=$row["D_Report"];
                    $Count=$row["Count"];
                  }                  
                else if($Type=='5')
                    $upd=1;              
                else
                    $upd=0; 
                 $min=$x;                        
              }
            }
          }

        if($min==10 && $Type<='2') 
          {
            file_put_contents($path, $decoded_string);
            $Srn=$Type*10000000000+$pinco*10000+$n;
            $sq = "INSERT INTO `my_information`(`Srn`, `D_Report`, `Count`, `Loc1`, `Loc2`, `Status`,`Address`,`Image1`) VALUES('$Srn','$D_Report','1','$Lat','$Long','$Status','$y[1]','$path')";
          }
        else
          { 
            if($upd!=1)
             {
               $Count++;
               $sq="UPDATE `my_information` SET `Count`='$Count' WHERE  `Srn`='$Srn'"; 
             }              
            else
             {            
               file_put_contents($path, $decoded_string);
               $sq = "UPDATE `my_information` SET `D_Solved`='$D_Report',`Status`='1',`Image2`='$path' WHERE `Srn`='$Srn' AND `Status`='0'";
             }      
          }
    }
  
    $sq1="INSERT INTO `description`(`Srn`, `des`) VALUES ('$Srn','$Description')";
     if(mysqli_query($conn ,$sq)&&mysqli_query($conn ,$sq1))
      {                    
        $sq2="SELECT `sla` FROM `SLA` WHERE  `type`='$Srn[0]'";  
        $result2 = mysqli_query($conn, $sq2);
        $row2 = mysqli_fetch_assoc($result2);
        echo $upd."x";
        echo $Srn."a";
        echo $l1."b";
        echo $l2."c";
        echo $D_Report."d";
        echo $row2['sla']."e";                  
      }
else
echo "2";

}


function distance($lat1, $lon1, $lat2, $lon2) {
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
   return ($miles * 1.609344*1000);
}

function getAddress($latitude,$longitude){
    if(!empty($latitude) && !empty($longitude)){
        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=true&key=AIzaSyDQTfCWmH3aoNypNm94nD7A8l4Weu627aM&callback=initMap');  
        $output = json_decode($geocodeFromLatLong);    
        $status = $output->status;
        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
        if(!empty($address)){         
          $pin= explode( 'Maharashtra ', $address );  
          $pincode= explode( ',', $pin[1] );         
          return $pincode[0]."**".$address;          
        }
}
}
mysqli_close($conn);
?>              