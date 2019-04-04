<?php  
/*Connect to the local server using Windows Authentication and   
specify the AdventureWorks database as the database in use. */  
$serverName = "VIETLIEU9798\SQLEXPRESS";  

$connect = array("Database" => "Coffee" , "UID" => "sa" , "PWD" => "11121061","CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName,$connect);

/* Close connection resources. */  
  
?>  