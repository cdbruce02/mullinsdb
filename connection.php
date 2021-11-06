<?php
session_start();
$dbhost = 'mullins-db1.ctnujdqmdjud.us-east-2.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'mullinsdb';
$charset = 'utf8' ;

$username = '-------';
$password = '---------';

$link = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);

//Check Connection

if($link === false){
  echo "Connection failed";
}
?>
