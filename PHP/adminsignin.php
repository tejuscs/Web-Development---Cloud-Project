<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <noscript>This site requires you to turn on JavaScript</noscript>
<title>User Information </title>

</head>
<style>

label,h2{
  color: rgb(243,17,9);
  font-family: "Lucida Sans", Verdana, Arial, sans-serif;
 font-size: 1em;

 }
 #footer{
    font-style: italic;
 }
 a.cgunners {
   	float:left;
   	font-size:17;
   	color:red;
   	text-decoration:none;
   }
 
   a.signup {
   	float:left;
   	font-size:17;
   	color:red;
   	text-decoration:none;
   }

   <?php
// define variables and set to empty values
$unameMand = $unameAdmin = $pwdlMand = $invalidpwdp = "";
$unameErr = $emailErr = $pwdErr = $cpwdErr = $fnameErr = $lnameErr = $bdayErr = $phoneErr = "";
$flag=0;

$uname = $pwd ="";

if (empty($_POST["uname"]) || empty($_POST["pwd"]) ) {
     $unameMand = "User Name is required";
	 $pwdMand = "Password is required";
	 //$flag="false";
   } else 
   {
	   if($_POST["uname"] != "Admin"){
		   echo "1";
		  // if(empty($_POST["uname"])){
		   $unameAdmin = "please enter a valid admin username";
	   }else
	   {
   		  // $unameAdmin = "I am a admin username";
		   $uname = "Admin";
		      $pwd = test_input($_POST["pwd"]);

		   
		    require_once 'loginfinalproj.php';
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			$query    = "select * from united where uname='$uname' and pwd='$pwd'";
			$result   = $conn->query($query);
			//echo $result->num_rows;
			if ($result->num_rows == 0){
			$failureMsg = "*****User name and password do not match*****";
			}else
			{
				    header ("location:Adminmultidelete.php");
				}
	   }
   }
    
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
?>
</style>
<body background="images/page2.jpg">
<form name="adminsignin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<div style="display:block;" id="reguser" name="reguser">

	<i><a class="cgunners" href="client3.php">&nbsp; Present RCBians | </a></i>
	<i><a class="signup" href="homepage.html">&nbsp; Home &nbsp;</a></i>
	<br>
	<br>
	<br>

<label><label>
<label>username:<label> 
<br/>
<input type="text" name="uname" value="">
   <span class="error"><?php echo $unameMand;?></span>
   <span class="error"><?php echo $unameAdmin;?></span>
   <br/>

<label>password:<label> 
<br/>
<input type="password" name="pwd" value="">
   <span class="error"> <?php echo $pwdMand;?></span>
   <span class="error"> <?php echo $invalidpwdp;?></span>
<br/>

<input type="submit" name="create" value="Login"/>
   <span class="error"> <?php echo $failureMsg;?></span>

</div>
</form>
<br/>
</body>

</html>
