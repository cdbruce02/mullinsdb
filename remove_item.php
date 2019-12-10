<?php
require 'connection.php';
function phpAlert($msg) {
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
$ItemID = $_POST["remid"];

//Set up SQL Queries
$findItem = $link->prepare("SELECT ItemID, ItemName, QTY, zone, subsection FROM full_display WHERE ItemID = ?");
$findItem->bind_param("s", $ItemID);
$findItem->execute();
$result = $findItem->get_result();

//If there is an item with that ID, then Delete the item from all three tables
if ($result->num_rows > 0){
  $row = $result->fetch_assoc();
  phpAlert("Deleting " .  $row['ItemName'] . "item with Item ID: " . $ItemID . ".  Press OK to continue.");
  //Set up remove query
  $removeItem1 = $link->prepare("DELETE FROM itemidname WHERE ItemID = ?");
  $removeItem2 = $link->prepare("DELETE FROM itemQTY WHERE itemID = ?");
  $removeItem3 = $link->prepare("DELETE FROM itemlocation WHERE itemID = ?");

  //bind parameters
  $removeItem1->bind_param("s", $ItemID);
  $removeItem2->bind_param("s", $ItemID);
  $removeItem3->bind_param("s", $ItemID);

  //execute queries
  $removeItem1->execute();
  $removeItem2->execute();
  $removeItem3->execute();

  //close queries
  $removeItem->close();
  $removeItem2->close();
  $removeItem3->close();
  phpAlert("Item Successfully Deleted!");
  $url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com';
  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
} else {
  //If you can't find anything, make a pop-up that says there is nothing and then redirect back to login landing page
  phpAlert("Couldn't find any items with that ID. Please try again.");
  $url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com';
  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
}
$link->close();
?>
