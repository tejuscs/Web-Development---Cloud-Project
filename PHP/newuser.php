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
$unameformatErr = $passFormatError = $passconfirmError = $LastFormatError = $checkError ="";
$uname = $email = $pwd = $cpwd = $fname = $lname = $sex = $bday = $phone = $photo = $favplayer = $moment ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (empty($_POST["uname"])) {
     $unameMand = "User Name is required";
	 //$flag="false";
   } else 
   {
   $uname = test_input($_POST["uname"]);
   if(!preg_match('/^[a-zA-Z0-9@_]*$/',$uname))
   {
    $unameformatErr='Please chose another username. User name can only contain alpha, numbers,@_ are allowed';
   }else
   {
   require_once 'loginfinalproj.php';
     $conn = new mysqli($hn, $un, $pw, $db);
  
     if ($conn->connect_error) die($conn->connect_error);
        $query    = "select * from united where uname='$uname'";
	    $result   = $conn->query($query);
		//echo $result->num_rows;
     if ($result->num_rows != 0){
	   $failureMsg = "This user name already exists. Please chose some other username.";
     }else $flag++;	  
	  
   }   
   
   }
if (empty($_POST["email"])) {
     $emailMand = "Email Id is required";
	 //$flag="false";
   } else 
   {
   $email = test_input($_POST["email"]);
   require_once 'loginfinalproj.php';
     $conn = new mysqli($hn, $un, $pw, $db);
  
     if ($conn->connect_error) die($conn->connect_error);
        $query    = "select * from united where email='$email'";
	    $result   = $conn->query($query);
		//echo $result->num_rows;
     if ($result->num_rows != 0){
	   $EmailExistMsg = "This email address already exists. Please chose some other email ID.";
     }else $flag++;
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
	 
   } else 
   {
   $bday = test_input($_POST["bday"]);
   list($y, $m, $d) = explode('/', $bday);
   if($y <= '2015')
   {
	   if( $m<='4')
	   {
		if( $d<='27')
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
  	  $phoneError = "Phone number can contain only numbers";
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
<body background="images/fan_background.jpg">
<form name="RegUser" enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<div style="display:block;" id="reguser" name="reguser">

	<i><a class="cgunners" href="client3.php">&nbsp; Present RCBian's | </a></i>
	<i><a class="signup" href="homepage.html">&nbsp; Home &nbsp;</a></i>
	<br>
	<br>
	<br>

<h2>RCBian Information </h2>
<label><label>
<label>username:<label> 
<br/>
<input type="text" name="uname" value="">
   <span class="error">* <?php echo $unameMand;?></span>
   <span class="error"> <?php echo $unameformatErr;?></span>
   <span class="error"> <?php echo $failureMsg;?></span>
     
<br/>

<label>email Id:<label> 
<br/>
<input type="email" name="email" value="">
   <span class="error">* <?php echo $emailMand;?></span>
   <span class="error"> <?php echo $EmailExistMsg;?></span>
    
<br/>
<label>password:<label> 
<br/>
<input type="password" name="pwd" value="">
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
<input type="text" name="fname" value=""/>
   <span class="error">* <?php echo $fnameMand;?></span>
   <span class="error"> <?php echo $FirstFormatError;?></span>
<br/>
<label> last name: </label>
<input type="text" name="lname" value=""/>
   <span class="error">* <?php echo $lnameMand;?></span>
   <span class="error"><?php echo $LastFormatError;?></span>
   <br/><br/>
<label>gender:</label>
<input type="radio" name="sex" value="male"><label>Male</label>
<input type="radio" name="sex" value="female"><label>Female<label>
   <span class="error">* <?php echo $sexMand;?></span> 
<br/><br/>
<label> birthday </label>
<input type="date" name="bday">
   <span class="error">* <?php echo $bdayMand;?></span>
   <span class="error"><?php echo $dateError;?></span>
   
   
<br/><br/>
<label> phone </label>
<input type="phone" name="phone">
   <span class="error">* <?php echo $phoneMand;?></span>
   <span class="error"><?php echo $phoneError;?></span>
   <br/><br/>
<label>upload a diplay pic</label>
<input type="file" name="photo"/>
<span class="error"><?php echo $imageextError;?></span>
<span class="error"><?php echo $imagesizeError;?></span>



<br/><br/>
<label>favourite player</label>
<input type="text" name="favplayer" value=""/>
<br/><br/>
<label> favourite RCB moment</label>
<textarea rows="3" cols="30" name="moment" value=""/></textarea>
<br/><br/>
<input type="checkbox" name="agree" value=""> <label>I accept the <a href="terms.html">terms and condition</a></label>

<span class="error"><?php echo $checkError;?></span>

<br/><br/>
<input type="submit" name="create" value="Create Profile"/>
<input type="reset" name="clear" value="Clear"/>
</div>
</form>
<br/>
<footer id="footer"> * marks mandatory fields</footer>


<?php
//echo $flag;
if($flag >= 12){
	//echo $flag;
  require_once 'loginfinalproj.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
      $query    = "INSERT INTO united (uname,email,pwd,fname,lname,gender,bday,image,favplayer,favmom,phone)  VALUES" .
      "('$uname', '$email','$pwd', '$fname', '$lname', '$sex', '$bday', '$photo', '$favplayer', '$moment', '$phone')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
	  else
	 
  header ("location: client2.php");
	  
	  $query2  = "SELECT * FROM united";
 $result = $conn->query($query2);
  if (!$result) die ("Database access failed: " . $conn->error);


$flag=0;
}
?>

</body>

</html>
