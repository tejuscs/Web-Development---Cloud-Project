

<html >
  <head>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
 <style>
   a.login {
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
   a.createprof {
   	float:left;
   	font-size:17;
   	color:red;
   	text-decoration:none;
   }
   
   table {
 font-family: "Lucida Sans", Verdana, Arial, sans-serif;
 font-size: 1em;
}
tbody {
 background-color: rgb(219,60,76);
 opacity: 0.8;

}
td, th {
 padding: 0.5em;
}
thead, tfoot {
 background-color: rgb(243,17,9);
opacity: 0.8;
}
caption {
 font-size: 1.2em;
 font-weight: bold;
 background-color: rgb(9,126,243);
 padding: 0.5em;
opacity: 0.65;
}
tbody tr:nth-child(odd) {
 background-color: rgb(179,188,177);
opacity: 0.8;
}
   </style>
 
  </head>
  <body>
  <form name="adminsignin" method="post" action="#"> 
	<i><a class="login" href="usersignin.php">&nbsp; Edit My Profile | </a></i>
	<i><a class="signup" href="homepage.html">&nbsp; Home | &nbsp;</a></i>
	<i><a class="signup" href="newuser.php">&nbsp; Create Profile &nbsp;</a></i>
<?php
$Msg = $Msg1 ="";
$idlistimp = implode(', ', $_POST['idlist']);
            require_once 'loginfinalproj.php';
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error) die($conn->connect_error);
			$query    = "select * from united where id in ($idlistimp)";
			$result   = $conn->query($query);
			if($result->num_rows == 0)
			{
				$Msg = "*****You forgot to select IDs. Did not delete anything*****";
			}else
			{
				$query2    = "delete from united where id in ($idlistimp)";
				$result2   = $conn->query($query2);
				//echo $result->num_rows;
				if (!$result2) 
				echo "INSERT failed: $query<br>" .
				$conn->error . "<br><br>";
				else $Msg1 = " *****records with IDs =>$idlistimp are successfully deleted*****";
			}
?>
	
	<br>
	<br>

<table id="msg">
   <caption>RCB!</caption>
   <thead>
      <tr> 
        <th scope="col">picture</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">FirstName</th>
        <th scope="col">LastName</th>
        <th scope="col">Gender</th>
		<th scope="col">Birthday</th>
        <th scope="col">Phone</th>
        <th scope="col">Favourite Player</th>
        <th scope="col">RCB Moment</th>
      </tr>
   </thead>
   </table>

  
  <div id="msg"><h3></h3></div>

<script type="text/javascript">
 
$(document).ready(function(){
var url="api3.php";
$.getJSON(url,function(json){
// loop through the members here

$.each(json,function(i,dat){
$("#msg").append(
'<tr>'+	
'<td scope="col" ><img height="100" width="100" src="data:image;base64,'+dat.image+'"></td>'+
'<td scope="col">'+dat.uname+'</td>'+
'<td scope="col">'+dat.email+'</td>'+
'<td scope="col">'+dat.fname+'</td>'+
'<td scope="col">'+dat.lname+'</td>'+
'<td scope="col">'+dat.gender+'</td>'+
'<td scope="col">'+dat.bday+'</td>'+
'<td scope="col">'+dat.phone+'</td>'+
'<td scope="col">'+dat.favplayer+'</td>'+
'<td scope="col">'+dat.favmom+'</td>'+
'</tr>'
);
});

});
});

</script>

   <span class="error"> <?php echo $Msg;?></span>
   <span class="error"> <?php echo $Msg1;?></span>
   <br>
   <br>
  <i><a class="login" href="Adminmultidelete.php">&nbsp; Click to delete more </a></i>
<br><br><br><br>

</form>
</body>
</html>
