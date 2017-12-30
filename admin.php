<?php
error_reporting(0);
session_start();
$_SESSION['login']="";
$any="please login first";
if($_POST['login']=="login")
{
$email=$_POST['email'];
$add=$_POST['pass'];
if($email=="vpraykaadmin@vpray.app" && $add=="pothole")
$_SESSION['login']="yes";
else{
$_SESSION['login']="error";
$any="wrong emailid/password combination";
}
}



if($_POST['login']=="sla")
{
require 'databaseconn.php';
$_SESSION['login']="x";
$type=$_POST["type"];
$sla=$_POST["sla"];

$sq="UPDATE `SLA` SET `sla`='$sla' WHERE `type`='$type' ";
if(mysqli_query($conn,$sq))
echo "<script>alert('SLA Changed Successfully');</script>";
else
echo "<script>alert('Server error');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(window).load(function(){
             
               var action="<?php echo $_SESSION['login'];?>";
             	
              if(action== "error" ||action== ""  ){
                $('#myModal').modal({backdrop: 'static', keyboard: false});               
              }
          
            else  if(action== "yes"||action== "x"){              
                   document.getElementById('adminview').style.display='block';  
                   document.getElementById('adminview1').style.display='block';   
                       document.getElementById('adminview2').style.display='block';        
              }
             
          });
</script>
<style>

html,body{
    height: 100%;
    padding: 0!important;
    margin: 0!important;
  }
</style>
</head>
<body>
<div class="panel panel-info">
      <div class="panel-heading"><h1 align="center" style="color:#01579B;">Welcome To Admin Page</h1></div>
    </div>

<div class="container" id="adminview" style="display:none;">
  <h2 style="color:#9E9E9E"><span class="glyphicon glyphicon-cog" style="text-size:18px;"></span>Settings</h2>
 <div class="panel panel-default">
 <div class="panel-heading">Change SLA</div>
 <div class="panel-body">
  <form class="form-inline" action="" method="POST" name="a">
    <div class="form-group">
      <label for="type" style="color: red"><b>SELECT PROBLEM TYPE:</b></label>
      <label> <input type="radio" name="type" value="1" checked> Pothole
               <input type="radio" name="type" value="2"> Garbage</label>
      </br>
      <label for="sla" style="color: red"><b>ENTER NEW SLA:</b></label>
      <input type="number" class="form- control" id="number" name="sla" autofocus required min="1">
    
      </br>
    <button type="submit" class="btn btn-red" value="sla" name="login">Submit</button></div>
  </form>
</div>
</div>
</div>
</br>
</div>

<a id="adminview2" href="app.php" target="newwindow" style="text-size:15px; margin-left:40%;">Click here to view all problems</a>
<h5 style="margin-left:40%; text-size:15px; color:red;">Close this window to logout</h5>
<!-- login modal starts-->
 <div class="modal fade" id="myModal"  role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="w3-model">
         <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      
            <div class="w3-center"><br>
             
              <img src="http://conforganiser.com/application/views/assets/sitetheme/images/author_default.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
            </div>

            <form class="w3-container" action="" autocomplete="on" method="POST" name="a">
          
              <div class="w3-section">
                <label><b>admin email</b></label>
                <input id="em" class="w3-input w3-border w3-margin-bottom" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  name="email" oninvalid="setCustomValidity('enter your valid email address')" onchange="try{setCustomValidity('')}catch(e){}"  required autofocus="on">

                <label><b>Password</b></label>
                <input class="w3-input w3-border" id="pass3" type="password"   name="pass"  >
                <p></p>
                <label  id="vvmp" style="color:red"><?php echo "$any";?>
              </label>
              <br>

                <button class="w3-btn-block w3-green w3-section w3-padding" type="submit" value="login" name="login">Login</button>
              
              
              </div> 
             </form>
            

            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
             
             
            </div>
           
         </div>
        </div>
      </div>
    </div>
  </div><!-- login modal ends-->

</body>
</html>


