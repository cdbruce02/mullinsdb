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
    <nav class="is-dark navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item">
          <img src="/images/logo.png" href="..">
        </a>
        <a id="title" class="navbar-item is-size-4" href="..">VultureDB</a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href=/images/mullins.jpg target="_blank" title="Open Room Map in New Tab">Map</a>
          <a class="navbar-item" href=/login_landing.php>Teacher Login</a>
          <a class="navbar-item" href=/instructions.html>Instructions</a>
          <a class="navbar-item" href=/overview.html>Info</a>
        </div>
        <div class="navbar-end">
          <div class="navbar-item is-active">
            <div class="searchbar">
              <form action="query.php" method="POST">
                <div class="select">
                  <select name="category">
                    <option>Search By Category</option>
                    <option value="0">Vex/Knex</option>
                    <option value="1">Electronics</option>
                    <option value="2">School Supplies</option>
                    <option value="3">Tools</option>
                    <option value="4">Wood</option>
                    <option value="5">Hardware</option>
                    <option value="6">Cardboard/Foam/Plastic</option>
                    <option value="7">Mechanical</option>
                    <option value="8">Wiring</option>
                    <option value="9">Misc</option>
                  </select>
                </div>
                <input id="search" type="text" placeholder="Type here" name="searchreq" class="input"style="font-family:'Lato'">
                <input id="submit" type="submit" value="Search" class="button">
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
<div class="page">
<div class="table-container">
<?php
require 'connection.php';

//SQL Query
$sql = "SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE zone LIKE ? ORDER BY zone, subsection";

$stmt = $link->prepare($sql);

//Pass color post request
$search = '%'.$_POST["color"].'%';

//Set all incoming inputs from search bar to be a string, thereby ignoring any inputs that are SQL commands
$stmt->bind_param("s", $search);

// Execute query
$stmt->execute();

//get the result as an array
$result = $stmt->get_result();

// if 1+ rows in array then output results in a table
if ($result->num_rows > 0){
  echo "<table class='table is-hoverable'><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Location</th></tr>";
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
