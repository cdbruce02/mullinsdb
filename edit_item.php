<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <link rel="stylesheet" type="text/css" href="queryresult.css">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
<?php
require 'connection.php';
function phpAlert($msg) {
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
$ItemID = $_POST["editid"];

//Set up SQL Queries
$findItem = $link->prepare("SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE ItemID = ?");
$findItem->bind_param("s", $ItemID);
$findItem->execute();
$result = $findItem->get_result();
if ($result->num_rows > 0){
  $row = $result->fetch_assoc();
} else {
  phpAlert("Couldn't find any items with that ID. Please try again.");
  header("Location: /login_landing.html ");

}

?>
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
          <a class="navbar-item" href=/login_landing.html >Teacher Login</a>
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
<div class="container">
  <div class="tile is-ancestor">
    <div class="tile is-parent">
      <div class="tile is-child box">
        <div class="oldInfo">
          <form>
          Item ID: <input type="text" id="olditemid"  value="<?php echo $row["ItemID"] ?>" class="input" readonly>
          Old Item Name: <input type="text" id="olditemname" value="<?php echo $row["ItemName"] ?>" class="input" readonly>
          Old Item Quantity: <input type="text" id="olditemqty"  value="<?php echo $row["QTY"] ?>" class="input" readonly>
          Old Zone: <input type="text" id="olditemzone" value="<?php echo $row["zone"] ?>" class="input" readonly>
          Old Subsection: <input type="text" id="olditemsub"  value="<?php echo $row["subsection"] ?>" class="input" readonly>
          </form>
        </div>
      </div>
    </div>
    <div class="tile is-parent">
      <div class="tile is-child box">
        <div class="newInfo">
          <form action="edit_item2.php" method="POST">
            Item ID: <input type="text" name="newitemid"  value="<?php echo $row["ItemID"] ?>" class="input" readonly>
            Item Name: <input type="text" name="newitemname"  placeholder="Item Name" class="input">
            Item Quantity: <input type="text" name="newitemqty"  placeholder="Item Quantity" class="input">
            Zone: <br> <div class="select">
              <select name = "newitemzone">
                <option>Enter a zone</option>
                <option value="Red">Red</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
                <option value="Purple">Purple</option>
                <option value="Yellow">Yellow</option>
              </select>
            </div><br>
            Subsection: <input type="text" name="newitemsub"  placeholder="Item Subsection" class="input">
            <input type="submit" id="submit" value="Insert" class="button">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
