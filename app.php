<?php
error_reporting(0);
session_start();
echo "<script> var latn=[];var long=[];var srn=[];var des=[]; var drp=[]; var count=[]; var image=[];var ndes=[];var type=[];var st=[];var image2=[];var Dos=[];var Address=[]; </script>";
$i=$prt=$psv=$grt=$gsv=0;
include 'databaseconn.php';
$add=$_GET['address'];
$query ="SELECT * FROM `my_information` WHERE Address LIKE '%$add%'";
 $result = mysqli_query($conn, $query);
 $n=mysqli_num_rows($result);
if($n==0 || $add==""){
if($n==0)
echo "<script>alert('no issue can be found here');</script>";
$query ="SELECT * FROM `my_information` ";
$add="Mumbai";
 $result = mysqli_query($conn, $query);
 $n=mysqli_num_rows($result);
if($n==0)
echo "<script>alert('You are living in very clean city..congratulations');</script>";
$j=0;
while ($row = mysqli_fetch_assoc($result))
   {
echo "<script>  st[$i]='unsolved' ;</script>";
$lat=$row['Loc1'];
 $long=$row['Loc2'];
$type=$row['Srn'][0];
if($type=="1"){
   $type="Pothole";
  if($row['Status']==1)
    {
     $psv++;
     echo "<script>  st[$i]='solved' ;</script>";
    }
  
  $prt++;
}
else {
 $type="Garbage";
  if($row['Status']==1)
    {
     $gsv++;
     echo "<script>  st[$i]='solved' ;</script>";
    }
  
  $grt++;
}
$Srn=$row['Srn'];
$img=$row['Image1'];
$a=$row['Address'];
$ds=$row['D_Solved'];
if($ds=="0000-00-00")
$ds=" --";
$img2=$row['Image2'];
$dp=$row['D_Report'];
$count=$row['Count'];
$qu ="SELECT des FROM `description` WHERE Srn = '$Srn'";
 $res = mysqli_query($conn, $qu);
 $n1=mysqli_num_rows($res);
echo "<script>  Address[$i]='$a';image2[$i]='$img2';Dos[$i]= '$ds';ndes[$i]=$n1;latn[$i]= $lat;long[$i]= $long;srn[$i]=$Srn ;drp[$i]= '$dp';count[$i]=$count;image[$i]='$img';type[$i]='$type';</script>";

while ($row1 = mysqli_fetch_assoc($res))
{
$q=$row1['des'];
echo "<script>  des[$j]='$q' ;</script>";
$j++;
}
$i++;
}

}

else{
$j=0;
while ($row = mysqli_fetch_assoc($result))
   {
echo "<script>  st[$i]='unsolved' ;</script>";
$lat=$row['Loc1'];
 $long=$row['Loc2'];
$type=$row['Srn'][0];
if($type=="1"){
   $type="Pothole";
  if($row['Status']==1)
    {
     $psv++;
     echo "<script>  st[$i]='solved' ;</script>";
    }
  
  $prt++;
}
else {
 $type="Garbage";
  if($row['Status']==1)
    {
     $gsv++;
     echo "<script>  st[$i]='solved' ;</script>";
    }
  
  $grt++;
}
$Srn=$row['Srn'];
$img=$row['Image1'];
$a=$row['Address'];
$ds=$row['D_Solved'];
if($ds=="0000-00-00")
$ds=" --";
$img2=$row['Image2'];
$dp=$row['D_Report'];
$count=$row['Count'];
$qu ="SELECT des FROM `description` WHERE Srn = '$Srn'";
 $res = mysqli_query($conn, $qu);
 $n1=mysqli_num_rows($res);
echo "<script>  Address[$i]='$a';image2[$i]='$img2';Dos[$i]= '$ds';ndes[$i]=$n1;latn[$i]= $lat;long[$i]= $long;srn[$i]=$Srn ;drp[$i]= '$dp';count[$i]=$count;image[$i]='$img';type[$i]='$type';</script>";

while ($row1 = mysqli_fetch_assoc($res))
{
$q=$row1['des'];

echo "<script>  des[$j]='$q' ;</script>";
$j++;
}
$i++;
}
}

 $searched=$add;
if($searched=="")
   $sql="SELECT * FROM  my_information ";
else
    $sql="SELECT * FROM  my_information WHERE Address LIKE '%$searched%'";
    $result=$conn->query($sql);

?>

<html>
<head><title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJ0gDuCXwa796QTlP0alkXVza9FcUYjLE&callback=initMap&libraries=places">
    </script>
    <script>
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {


        var p=<?php echo $prt;?>;
        var ps=<?php echo $psv;?>;
         var g=<?php echo $grt;?>;
        var gs=<?php echo $gsv;?>;
          var area='total reported in '+'<?php echo $add;?>';
        var data = google.visualization.arrayToDataTable([
          ['Type',area, 'solved'],
          ['Pothole', p, ps],
          ['Garbage', g, gs]
        ]);

        var options = {
          chart: {
            title: 'VPRAY service',
            subtitle: 'we are happy to help you',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
   

    function checkInput(ob) {
  var invalidChars = /[^0-9]/gi
  if(invalidChars.test(ob.value)) {
            ob.value = ob.value.replace(invalidChars,"");
      }
     
}


      function initMap() {
       var x=15;
       var aa='<?php echo $add;?>';
       var mm='mumbai';
     if (aa.toLowerCase() === mm.toLowerCase())
        x=10;
       var i,image1;
        var marker;
        var uluru = {lat: latn[0], lng:long[0] };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: x ,
         disableUi: true,
          center: uluru
        });
         var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


         map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
        
       searchBox.addListener('places_changed', function() { 
       var a=document.getElementById('pac-input').value;
       var numb = a.match(/\d/g);
       if(numb!=null && numb!=undefined)
       numb = numb.join("");
       else{
      var c=a.split(" ");
       var b=c[0].split(",");
      numb=b[0];
           }
       document.getElementById('address').value= numb;
       document.getElementById('submit').click();
          });
        var n=<?php echo $n;?>;
        
       for(i=0;i<n;i++){
        if(type[i]=="Garbage")
       image1 = 'http://vpray.esy.es/orange.png';
        else
       image1 = 'http://vpray.esy.es/pink.png';

            uluru = {lat: latn[i], lng:long[i] };
        marker = new google.maps.Marker({
          position: uluru,
          icon: image1,
          id:i,
          map: map
        });

     


          google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            var i1=marker.id;
          var x="http://vpray.esy.es/"+image[i1]+".jpeg";
          if(image2[i1]!="")
          {
              document.getElementById("solvedimg").style.display='block';
            var y="http://vpray.esy.es/"+image2[i1];
             document.getElementById("problemimage2").src =y;
           
          }
              
           document.getElementById("typeofproblem").innerHTML =type[i1];
          document.getElementById("problemimage").src =x;
             document.getElementById("Srn").innerHTML =srn[i1];
             document.getElementById("drp").innerHTML =drp[i1];
             document.getElementById("count").innerHTML =count[i1];
              document.getElementById("location").innerHTML =Address[i1];
             document.getElementById("status").innerHTML =st[i1];
            document.getElementById("dos").innerHTML =Dos[i1];


document.getElementById("des").innerHTML="";

var like=0;
for (var i2 = 0; i2 <i1 ; i2++)
like+=ndes[i2];
  var table = document.createElement('table');
for (var i3 = 1; i3 <=ndes[i1] ; i3++){
    var tr = document.createElement('tr');   

    var td1 = document.createElement('td');
   

    var text1 = document.createTextNode(des[like++]);
   
    td1.appendChild(text1);
   
    tr.appendChild(td1);
   
    table.appendChild(tr);
}
document.getElementById("des").appendChild(table);

             $('#myModal1').modal('show');
         
        }
      })(marker, i));
      }
    
}
  </script>
     </head>
 
<style>

      #map {
        width: 100%;
        height: 400px;
        background-color: grey;
      }
.modal-header
{
  text-align:center;
}
   
 .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }
table, th, td 
{
    border: 1px solid black;
    border-collapse: collapse;
    text-align:center;
}

  .icon-bar{
    background-color:white;
  }


  .modal-footer {
      background-color: #f9f9f9;
  }
 
  .navbar ,.navbar-inverse{
    background-color:white;
  }

 
  .affix {
      top: -10px;
      width: 100%;
       z-index:9999 !important;
  }
    .affix + .container-fluid {
      padding-top: 0px;
  }
  
  html,body{
    height: 100%;
    padding: 0!important;
    margin: 0!important;
  }
  .container-fluid{
    width: 100%;
    
  }
  .navbar{
      margin-bottom: 0px;
    }
  </style>
<body>

<!-- header start-->
<!-- navbar stats-->
<nav class="navbar " data-spy="affix" data-offset-top=35 style="background-color:#4FC3F7!important; border-radius:5px; margin-top:2px;">

          <div class="navbar-header" style="background-color:#4FC3F7">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"><p style="color:#01579B;"><b>Citizen Service</b></p></a>
          </div>
          
          <div class="collapse navbar-collapse navbar-right" id="nav" style="color:white;">
            <ul class="nav navbar-nav">
              <li ><a id="mapbtn"  href="#map" title="view every problems on map" style="color:#01579B;"><b>MAP</b></a></li>
              <li><a  id="statbtn" href="#columnchart_material" title="check static data of problems in graphic notation" style="color:#01579B;" ><b>STATICS</b></a></li>
              <li><a  id="statbtn" href="#table" title="check static data of problems" style="color:#01579B;"><b>DATA</b></a></li>
            </ul>
          </div>
 </nav><!-- navbar ends-->
<br>

<form action="" method="GET" style="display:none;"><input id="address" type="text" name="address" ><button id="submit" type="submit"></button></form> 
<div class="container-fluid" style="height:500px;">
          <div class="row">
          <div class="col-lg-5 col-sm-5 col-md-5">  
    <div class="panel panel-default">
    <div class="panel-heading">Statistics</div>
    <div class="panel-body">
     <div id="columnchart_material" style="width: 400px; height: 400px; margin-bottom:0px; padding-bottom:0px;"></div>
    </div>
    </div>
    </div>
<div class="col-lg-7 col-sm-7 col-md-7">   
    <div class="panel panel-default">
    <div class="panel-heading">Map</div>
    <div class="panel-body">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map" style="padding-left:15px;padding-right:15px; margin-bottom:0px;padding-bottom:0px;"></div>
    </div>
    </div>
</div>
</div>
</div>
<div class="container">
<div class="panel-group">
  <div class="panel panel-default">
<div class="panel-heading">Complete Info about <?php echo "$add"; ?></div>
    <div class="panel-body"> 
<center>
 <div class="table-responsive" id="table">
    <table>
        <thead style="background-color:#81D4FA;">
        <?php
        if(isset($add))
         echo "<th>Sr.No</th><th>Type</th><th>Location</th><th>Pincode</th><th>Date of report</th><th>Date of Solved</th><th>Status</th><th>No of people reported</th>"; 
        ?>
        </thead>
           <?php
            if(isset($add))
            {

             $count=0;
             if($result->num_rows > 0){
  
              while($row2=$result->fetch_assoc())
              {
               if($row2['Srn'][0]=="1")
                $type="pothole";
                else
                $type="Garbage";
                $drep=$row2['D_Report'];
                $dsol=$row2['D_Solved'];
                if($dsol=="0000-00-00")
                $dsol="--";
                $add=$row2['Address'];
               $pin= explode( ', Maharashtra ', $add ); 	
        	$pincode= explode( ',', $pin[1] ); 
                    
                $status=$row2['Status'];
                if($status=="1")
                $status="solved";
              else
                 $status="unsolved";
                $c=$row2['Count'];
                echo "<tr><td>$count</td><td>$type</td><td>$pin[0]</td><td>$pincode[0]</td><td>$drep</td><td>$dsol</td><td>$status</td><td>$c</td></tr>";
                $count+=1;
              }
             }
            }
           ?>
   </table>
</div>
</center>
</div>
</div>
</div>
</div>
</div>
   
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <span id="a" data-dismiss="modal" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
        <h3 class="modal-title" id="typeofproblem" style="color:red"></h3>
        <div class="container-fluid">
        <div class="row">
         <img  alt="Load Failed" style="width:60%" id="problemimage" class="w3-margin-top"  >
        </div>
        <div class="row" id="solvedimg" style="display:none;">
         <img  alt="unsolved" style="width:60%;" id="problemimage2" class="w3-margin-top"  >
        </div>
        </div>
        </div>

      <div class="modal-body">
       
     <form class="form-inline">
  <div class="form-group">
    <label style="color:#00796B">LOCATION</label>
   <label id="location"></label>
  </div>
<br>
  <div class="form-group">
    <label style="color:#00796B">SRN:</label>
   <label id="Srn"></label>
  </div>
<br>
<div class="form-group">
    <label style="color:#00796B">STATUS:</label>
   <label id="status"></label>
  </div>
<br>
  <div class="form-group">
    <label style="color:#00796B">DATE OF REPORT:</label>
   <label id="drp"></label>
  </div>
<br>
  <div class="form-group">
    <label style="color:#00796B">DATE OF SOLVED:</label>
   <label id="dos"></label>
  </div>
<br>
<div class="form-group">
    <label style="color:#00796B">NUMBER OF PEOPLES REPORTED THIS:</label>
   <label id="count"></label>
  </div>
 <br>
<div class="form-group">
    <label style="color:#00796B">COMMENTS ON THIS PROBLEM:</label>
  </div>
 <br>
<div class="panel panel-default">
<div class="panel-body">
<div class="form-group" id="des">
  </div>
  </div>  
  </div>

</form>
</div>
</div>
</div>

      </div>


      
  </div>
</div>





</body>
</html>
										