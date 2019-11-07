<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="queryresult.css">
</head>

<body>

<?php 
	require 'connection.php';

//SQL Query
$sql = "SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE ItemName LIKE ? ORDER BY zone, subsection";

$stmt = $link->prepare($sql);
	//Pass Searchreq post request
	$search = '%'.$_POST["searchreq"].'%';
	//Set all incoming inputs from search bar to be a string, thereby ignoring any inputs that are SQL commands
	$stmt->bind_param("s", $search);
	// Execute query
	$stmt->execute();
	//get the result as an array
	$result = $stmt->get_result();
	// if 1+ rows in array then output results in a table
	if ($result->num_rows > 0){
	echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Location</th></tr>";	
	while($row = $result->fetch_assoc()) {
		echo "<tr><td>".$row["ItemID"] ."</td><td>" . $row["ItemName"] . "</td><td>" . $row[QTY] . "</td><td>" . $row["zone"] . " " . $row["subsection"] . "</td></tr>";
	}
	} else {
		echo "Couldn't find anything";
	}

mysqli_close($link);

?>

</body>
</html>
