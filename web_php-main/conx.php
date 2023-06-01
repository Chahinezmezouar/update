<?php
$servername="localhost";
$username="root";
$password="";
$dbname="h2o_helper";
// Create database connection
$link = mysqli_connect($servername, $username, $password, $dbname);
  
// Check connection
if(mysqli_connect_error())
{
 echo "Connection establishing failed! <br >";
}
else
{
 echo "Connection established successfully. <br >";
}
?>

