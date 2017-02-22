<?php 
// rename this file to connection.php after fillling in your database credentials

define("DB_INFO", "mysql:host=localhost;dbname=databasename");
define("DB_USER", "username");
define("DB_PASS", "yourpassword");
// structural method extinct in php 7.0
// $host='localhost';
// $db1 = 'databasename';
//$con = mysql_connect($host, DB_USER,DB_PASS);
// structural checking
/*if (!$con) {
    die("Connection failed: " . mysql_connect_error());
}*/
//object oriented method
try {
    $db = new PDO(DB_INFO,DB_USER,DB_PASS);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
//strucrtural db connection extinct in php 7.0
/*$db_select=mysql_select_db($db1, $con);
  if (!$db_select){
  	die("database selection failed:". mysql_error()); 
  }*/
?>