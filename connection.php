<?php
$dbhost = 'mullins-db1.ctnujdqmdjud.us-east-2.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'mullinsdb';
$charset = 'utf8' ;

$username = 'cdbruce02';
$password = 'SF0P8Clay!';

$link = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);

//Check Connection

if($link === false){
  echo "Connection failed";
}
?>
