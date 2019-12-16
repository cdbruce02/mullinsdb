<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <link rel="stylesheet" type="text/css" href="queryresult.css">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
  <div id="navbar">
    <nav class="is-link navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a id="title" class="navbar-item is-size-4" href="..">Mr. Mullins' Inventory</a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href=/images/room_map.jpg target="_blank" title="Open Room Map in New Tab">Map</a>
          <a class="navbar-item" href=/login_landing.php>Teacher Login</a>
        </div>
        <div class="navbar-end">
          <div class="searchbar">
            <form action="query.php" method="POST">
              <input id="search" type="text" placeholder="Type here" name="searchreq" class="input"style="font-family:'Lato'">
              <input id="submit" type="submit" value="Search" class="button">
            </form>
          </div>
        </div>
      </div>
    </nav>
  </div>

<div class="page">
<div class="table-container">
<?php
require 'connection.php';

//SQL Queryi
$sql = "SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE ItemName LIKE ? ORDER BY zone, subsection";

$stmt = $link->prepare($sql);

//Pass color post request
$search = '%'.$_POST["searchreq"].'%';

//Set all incoming inputs from search bar to be a string, thereby ignoring any inputs that are SQL commands
$stmt->bind_param("s", $search);

// Execute query
$stmt->execute();

//get the result as an array
$result = $stmt->get_result();

// if 1+ rows in array then output results in a table
if ($result->num_rows > 0){
  echo "<table class='table'><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Location</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["ItemID"] ."</td><td>" . $row["ItemName"] . "</td><td>" . $row[QTY] . "</td><td>" . $row["zone"] . " " . $row["subsection"] . "</td></tr>";
  }
} else {
  echo "Couldn't find anything";
}

mysqli_close($link);

?>
</div>
</div>
</body>
</html>
