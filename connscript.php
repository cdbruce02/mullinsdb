<?php 
$dbhost = 'mullins-db.ctnujdqmdjud.us-east-2.rds.amazonaws.com';
$dbport = '3306';
$dbname = 'mullinsdb';
$charset = 'utf8' ;

$username = 'cdbruce02';
$password = 'SF0P8Clay!';

$link = mysqli_connect($dbhost, $username, $password, $dbname, $dbport);

//Check Connection
/*
if($link === false){
	echo "Connection failed";
} else {
	echo "Successfully connected!" . "<br>";
}
 */

//SQL Query for search bar
$sql = "SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE ItemName LIKE ?";

$stmt = $link->prepare($sql);
	//Pass Searchreq post request
	$search = '%'.$_POST["searchreq"].'%';
	$stmt->bind_param("s", $search);
	// Execute query
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0){
	echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Location</th></tr>";	
	while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["ItemID"] ."</td><td>" . $row["ItemName"] . "</td><td>" . $row[QTY] . "</td><td>" . $row["zone"] . " " . $row["subsection"] . "</td></tr>";
	}
	} else {
		echo "Couldn't find anything";
	}
	

//output data from each row as long as there is a result from the database

/*
	echo "Item ID: " . $row['ItemID'] . ".  Item Name: " . $row['ItemName'] . ".  Quantity: " . $row['QTY'] . ".  Location: " . $row['zon
// Free Result Set

 */
mysqli_close($link);

?>
