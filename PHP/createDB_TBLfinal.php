
<?php
require_once 'loginfinalproj.php';  // Contains our mysql login credentials
echo "login params: hostname = " . $hn . "; username = " . $un . "; password = ******* " . "; db name = " .$db;

// Create connection

$conn = new mysqli($hn, $un, $pw);




// Check connection

 if ($conn->connect_error) {
     echo "<br/>";
     die("Die - Connection failed: " . $conn->connect_error);

}


// Create database

$sql = "CREATE DATABASE " . $db ;
echo "<br/>";
echo "Create db sql: " . $sql;
if ($conn->query($sql) === TRUE) {
     echo "<br/>";
     echo "Database created successfully";
}   else {
     echo "<br/>";
     die("Die - Create DB failed: " . $conn->error);
}


// Close connection then reopen with $db
$conn->close();
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
   echo "<br/>";
   die("Connection with db failed: " . $conn->connect_error);
}  else {
     echo "<br/>";
     echo "Connection with db: $db succeeded";
}

/*
$sql = "CREATE TABLE lab9 (".
 "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,".
 "firstname VARCHAR(30) NOT NULL,".
 "lastname VARCHAR(30) NOT NULL,".
 "email VARCHAR(30) NOT NULL UNIQUE,".
 "pwd VARCHAR(30) NOT NULL,".
 "sec VARCHAR(30) NOT NULL,".
 "ans VARCHAR(30) NOT NULL)";
*/

$sql = "CREATE TABLE united (".
 "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,".
 "uname VARCHAR(30) NOT NULL UNIQUE,".
 "email VARCHAR(30) NOT NULL UNIQUE,".
 "pwd VARCHAR(30) NOT NULL,".
 "fname VARCHAR(30) NOT NULL,".
 "lname VARCHAR(30) NOT NULL,".
 "gender VARCHAR(2) NOT NULL,".
 "bday DATE NOT NULL,".
 "image LONGBLOB,".
 "favplayer VARCHAR(30),".
 "favmom VARCHAR(500),".
 "phone VARCHAR(30) NOT NULL)";
 
echo "<br/>";
echo "sql for create table: " . $sql;

if ($conn->query($sql) === TRUE) {
    echo "<br/>";
    echo "Table created successfully";

} else {
    echo "<br/>";
    echo "Error creating table: " . $conn->error;

}




echo "<br/>";
echo "Connected successfully";

 ?>
