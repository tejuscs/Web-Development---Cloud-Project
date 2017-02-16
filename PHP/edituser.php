<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
   <noscript>This site requires you to turn on JavaScript</noscript>
<title>User Information </title>

</head>
<Script type="text/javascript" language="javascript" src="js/NewUser.js" > </script>
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
$unameMand = $emailMand = $pwdlMand = $cpwdMand = $fnameand = $lnameMand = $sexMand = $bdayMand = $phoneMand = "";
$unameErr = $emailErr = $pwdErr = $cpwdErr = $fnameErr = $lnameErr = $bdayErr = $phoneErr = "";
$failureMsg = $EmailExistMsg = $FirstFormatError= $dateError = $phoneError = $imageextError = $imagesizeError="";
$flag=0;
$pic_flag=0;
$unameformatErr = $passFormatError = $passconfirmError = $LastFormatError = $checkError ="";
$uname = $email = $pwd = $cpwd = $fname = $lname = $sex = $bday = $phone = $photo = $favplayer = $moment ="";

$uname=$xuname;
$email=$xemail;
//$sex=$xsex;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["uname"])) {
     $unameMand = "User Name is required";
	 //$flag="false";
   } else 
   {
   $uname = test_input($_POST["uname"]);
   $flag++;
   }
   
if (empty($_POST["sex"])) {
     $sexMand = "Please select your gender";
	 //$flag="false";
   } else 
   {
   $sex = test_input($_POST["sex"]);
   $flag++;
   }

   
if (empty($_POST["email"])) {
     $emailMand = "Email Id is required";
	 //$flag="false";
   } else 
   {
   $email = test_input($_POST["email"]);
   $flag++;
   }
if (empty($_POST["pwd"])) {
     $pwdMand = "Password is required";
	 //$flag="false";
   } else 
   {
   $pwd = test_input($_POST["pwd"]);
   if(!preg_match('/^[a-zA-Z0-9@_]*$/',$pwd))
   {
      $passFormatError='Invalid password Format! Re-Enter Password!.Password can only contain alpha, numbers,@_ are allowed';
   }
   else
      {
	      $x= strlen($pwd);
		  if($x < 6){
			  $passFormatError='password should have at least 6 characters';
                    }else $flag++;
      }
   }

  if (empty($_POST["cpwd"])) {
     $cpwdMand = "Please confirm Password";
	 //$flag="false";
   } else 
   {
   $cpwd = test_input($_POST["cpwd"]);
   if($cpwd != $pwd)
   {
	$passconfirmError="The entered password do not match. Please re enter";   
   }else
   $flag++;
   }
if (empty($_POST["fname"])) {
     $fnameMand = "Please Enter First name";
	 //$flag="false";
   } else 
   {
   $fname = test_input($_POST["fname"]);
   if(!preg_match('/[a-zA-Z]/',$fname))
   {
      $FirstFormatError='First Name should contain only alphabets';
   }
   $flag++;
   }
if (empty($_POST["lname"])) {
     $lnameMand = "Please Enter Last name";
	 //$flag="false";
   } else 
   {
   $lname = test_input($_POST["lname"]);
   if(!preg_match('/[a-zA-Z]/',$lname))
   {
      $LastFormatError='Last Name should contain only alphabets';
   }else $flag++;
   }
 
if (empty($_POST["sex"])) {
     $sexMand = "Please select your gender";
	 //$flag="false";
   } else 
   {
   $sex = test_input($_POST["sex"]);
   $flag++;
   }
 
  if (empty($_POST["bday"])) {
     $bdayMand = "Please enter your birthday";
	 //$flag="false";
   } else 
   {
   $bday = test_input($_POST["bday"]);
   list($y, $m, $d) = explode('/', $bday);
   if($y <= '2016')
   {
	   if( $m<='4')
	   {
		if( $d<='24')
	    {
			$flag++;
		}else $dateError = " $bday birthday cannot be greater then current date"; 
	   }else $dateError = " $bday birthday cannot be greater then current date";
	   	 
   }else $dateError = " $bday birthday cannot be greater then current date";
   }

 if (empty($_POST["phone"])) {
     $phoneMand = "Please enter your phone number";
	 //$flag="false";
   } else 
   {
   $phone = test_input($_POST["phone"]);
   $x= strlen($phone);
   if($x == 10)
   {
	if (!preg_match("/^[0-9]*$/",$phone))  
	{
  	  $phoneError = "Phone number can have only numbers";
    }else $flag++;     	   
   }else $phoneError = "Phone number should be 10 digits";
   }
   
   
   
   if ((empty($_POST["photo"]))) {	   
     $validExt = array("jpg","png");
	 $validMime = array("image/jpeg","image/png");
	 foreach($_FILES as $fileKey=>$fileArray){
		 $extension=end(explode(".",$fileArray["name"]));
		 if(!in_array($extension,$validExt))
		 {
			 $imageextError = " please upload a file which is jpeg or png format";
 		 }else $flag++;
	 }
	 //$imagesizeError1 ="abcd";
	 $max_file_size=2000000;
	 foreach($_FILES as $fileKey=>$fileArray)
	 {
     		 if($fileArray["size"] > $max_file_size){
			 $imagesizeError = "  This file is too big to upload. Image cant be bigger then 2mb.";
		 } else $flag++;//else $imagesizeError = $fileArray["size"];
	 }
   }
    if(!isset($_POST['agree']))
	{
		$checkError =" you should agree to the terms";
	}else $flag++;
	
   //$photo = $_FILES["photo"];
   $photo= addslashes($_FILES['photo']['tmp_name']);
   $name= addslashes($_FILES['photo']['name']);
   $photo= file_get_contents($photo);
   $photo= base64_encode($photo);
     
   $favplayer = test_input($_POST["favplayer"]);
   $moment = test_input($_POST["moment"]);
     
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
<form name="RegUser" method="post" enctype="multipart/form-data" action=""> 
<div style="display:block;" id="reguser" name="reguser">

	<i><a class="cgunners" href="client3.php">&nbsp; Present RCBian | </a></i>
	<i><a class="signup" href="homepage.html">&nbsp; Home &nbsp;</a></i>
	<br>
	<br>
<?php 	
  require_once 'loginfinalproj.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
    session_start();
    $uname=$_SESSION['uname'];     
    $query    = "select * from united where uname='$uname'";
    $result   = $conn->query($query);
    $rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);

$xuname= $row[1];
$xemail= $row[2];
$xpwd= $row[3];
$xfname= $row[4];
$xlname= $row[5];
$xsex=$row[6];
$xbday=$row[7];
$xphoto=$row[8];
$xfavplayer=$row[9];
$xfavmoment=$row[10];
$xphone=$row[11];
}

?>	

<h2>RCBian Information </h2>
<label><label>
<label>username:<label> 
<label><?php echo $xuname;?><label> 
<br/><br/>


<label>email Id:<label> 
<label><?php echo $xemail;?><label> 
<br/><br/>
<label>password:<label> 
<br/>

<input type="password" name="pwd" value="<?php echo $xpwd;?>">
   <span class="error">* <?php echo $pwdMand;?></span>
   <span class="error"> <?php echo $passFormatError;?></span>
<br/>
<label>confirm password:<label> 
<br/>
<input type="password" name="cpwd" value="">
   <span class="error">* <?php echo $cpwdMand;?></span>
   <span class="error"><?php echo $passconfirmError;?></span>
<br/><br/>


<label> first name: </label>
<input type="text" name="fname" value="<?php echo $xfname;?>"/>
   <span class="error">* <?php echo $fnameMand;?></span>
   <span class="error"> <?php echo $FirstFormatError;?></span>

<br/>
<label> last name: </label>
<input type="text" name="lname" value="<?php echo $xlname;?>"/>
   <span class="error">* <?php echo $lnameMand;?></span>
   <span class="error"><?php echo $LastFormatError;?></span>
   <br/><br/>
<label>gender:</label>
<?php
if($xsex == 'ma'){   
echo "<input type='radio' name='sex' value='male' checked=true><label>Male</label>
<input type='radio' name='sex' value='female'><label>Female<label>";
}
else
{
echo "<input type='radio' name='sex' value='male'><label>Male</label>
<input type='radio' name='sex' value='female' checked=true><label>Female<label>";
}
?>
<!--<br/><br/>  
<label>gender:</label>
<label><?php echo $xsex;?><label> 
!-->
<br/><br/>
<label> birthday </label>
<input type="date" name="bday" value="<?php echo $xbday;?>"/>
   <span class="error">* <?php echo $bdayMand;?></span>
   <span class="error"><?php echo $dateError;?></span>

<br/><br/>
<label> phone </label>
<input type="phone" name="phone" value="<?php echo $xphone;?>"/>
   <span class="error">* <?php echo $phoneMand;?></span>
   <span class="error"><?php echo $phoneError;?></span>
   <br/><br/> 
<!--<label>My display pic :</label>
-->
<?php
//echo '<img height="100" width="100" src="data:image; base64,'.$xphoto.'">';
?>
<br/><br/>
<label> Would you like to change your DP? </label>
<input type="file" name="photo"/>
<br/><br/>
<label>favourite player</label>
<input type="text" name="favplayer" value="<?php echo $xfavplayer;?>"/>
<br/><br/>
<label> favourite RCBian moment</label>
<input type="text" name="moment" value="<?php echo $xfavmoment;?>"/>

<br/><br/>
<input type="submit" name="create" value="Update Profile"/>
<input type="submit" value="Delete Profile" name="remove"/>
</div>
</form>
<br/>
<footer id="footer"> * marks mandatory fields</footer>


<?php
if($flag >= '9'){
	
	require_once 'loginfinalproj.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    $query = "UPDATE united  set pwd='$pwd',fname='$fname',lname='$lname',gender='$sex',bday='$bday',image='$photo',favplayer='$favplayer',favmom='$moment',phone='$phone'".
	  "where uname='$uname'";
    $result = $conn->query($query);
    
    if (!$result) {
	   echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
    }
    else   
	{
		session_unset();
		header("location:client2.php");	 
		echo "9";
	
	}
$flag=0;
}
?>

<?php
if(isset($_POST['remove'])){
	
	require_once 'loginfinalproj.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    $query = "DELETE FROM united where uname='$uname'"; 
    $result = $conn->query($query);
    
    if (!$result) {
	   echo "DELETE failed: $query<br>" .
      $conn->error . "<br><br>";
    }
    else   
	{
		session_unset();
		header("location:deletesuccess.html");	 
	
	}
}
?>

</body>

</html>
