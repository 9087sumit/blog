<?php
$hostname = "127.0.0.1";
$dbuser="root";
$dbPassword="Qwerty@12345";
$dbName="blogo";
$conn=mysqli_connect($hostname,$dbuser,$dbPassword,$dbName);
if(!$conn){
    die("something went wrong");
}
?>