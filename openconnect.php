<?php
$servername = "mullins-db.ctnujdqmdjud.us-east-2.rds.amazonaws.com";
$username = "cdbruce02";
$password = "SF0P8Clay!";
$dbname = "mullinsdb";
$dbport = "3306"; 

//create connection
$conn =  mysqli_connect($servername, $username, $password, $dbname, $dbport);

// check connection
if ($conn === false){
	echo "Connection failed: ";
}else{
	echo "Successfully connected!";
}
?>
/*
<!DOCTYPE html>
<html>
<body>

<?php
$search = ($_POST["searchreq"]);

//echo $search;

$sql = "SELECT * FROM full_display WHERE ItemID LIKE '%".$search."%'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);

if($queryResults) > 0) {

	// output data of each row as long as there is a result from the database

	while($row = mysql_fetch_array($result)) {
		echo "<p><h3>".$row['itemID']."</h3>"

	}
} else {
	echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>
*/
