<?php 
$dbhost = 'mullins-db.ctnujdqmdjud.us-east-2.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'mullinsdb';
$charset = 'utf8' ;

$username = 'cdbruce02';
$password = 'SF0P8Clay!';

$link = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);

/* Check Connection
if($link === false){
	echo "Connection failed";
} else {
	echo "Successfully connected!";
}
*/
?>

<?php
$search = mysqli_real_escape_string($_POST["searchreq"]);

$sql = "SELECT * FROM full_display WHERE ItemID LIKE '%$search%'";
$raw_result = mysqli_query($link, $sql);
$result = mysqli_num_rows($raw_result);

if((mysqli_num_rows($raw_result)) > 0) {
	//output data from each row as long as there is a result form the database
	while($row = mysql_fetch_assoc($raw_result)) {
		//printf ("%s (%s) \n,", $row["ItemID"], $row["ItemName"], $row["QTY"], $row["zone"],$row["subsection"]);
		echo $row['ItemID']);
		echo $row['ItemName'];
		echo $row['QTY'];
		echo $row['zone']
	}
} else {
	echo ("no results :(");
}

// Free Result Set
mysql_free_result($raw_result);

mysqli_close($link);

?>
