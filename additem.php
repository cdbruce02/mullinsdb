<?php
require 'connection.php';
//Declare JavaScript alert function
function phpAlert($msg) {
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

//Set up SQL Queries
$sql = $link->prepare("INSERT INTO itemidname (ItemID, ItemName) VALUES (?, ?)");
$sql2 = $link->prepare("INSERT INTO itemQTY (itemID, QTY) VALUES (?, ?)");
$sql3 = $link->prepare("INSERT INTO itemlocation(itemID, zone, subsection) VALUES (?, ?, ?)");

//Pass input variables in
$itemid = $_POST["itemid"];
$itemname = $_POST["itemname"];
$itemQTY = $_POST["itemqty"];
$itemzone = $_POST["itemzone"];
$itemsubsection = $_POST["itemsub"];

//If values were all filled, then insert values. into the database.
if (!empty($itemid) && !empty($itemid) && !empty($itemQTY) && !empty($itemzone) && !empty($itemsubsection)) {

  //bind paramaters to be string
  $sql->bind_param('ss', $itemid, $itemname);
  $sql2->bind_param('si', $itemid, $itemQTY);
  $sql3->bind_param('sss', $itemid, $itemzone, $itemsubsection);

  //execute all statements
  $sql->execute();
  $sql2->execute();
  $sql3->execute();

  //echo out concat.
  phpAlert("Item successfully entered! ItemID: " . $itemid . " Item Name: ". $itemname. " Item QTY: ". $itemQTY. " Item Location: " . $itemzone. " " . $itemsubsection);

  //close out sql statements and the conneciton to the database
  $sql->close();
  $sql2->close();
  $sql3->close();
} else {
  phpAlert("Please complete all fields.");
}
//Redirect back to home page
$url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com/login_landing.php';
echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

$link->close();
?>

