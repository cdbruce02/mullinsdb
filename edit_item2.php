<?php
require 'connection.php';
function phpAlert($msg) {
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
  $ItemID = $_POST["newitemid"];

  $update1 = $link->prepare("UPDATE itemidname SET ItemName = ? WHERE ItemID = ?");
  $update2 = $link->prepare("UPDATE itemQTY SET QTY = ? WHERE itemID = ?");
  $update3 = $link->prepare("UPDATE itemlocation SET zone = ?,  subsection = ? WHERE itemID = ?");

//Pass input variables in
  $newitemname = $_POST["newitemname"];
  $newitemQTY = $_POST["newitemqty"];
  $newitemzone = $_POST["newitemzone"];
  $newitemsub = $_POST["newitemsub"];

//bind paramaters to be string
  $update1->bind_param('ss', $newitemname, $ItemID);
  $update2->bind_param('is', $newitemQTY, $ItemID);
  $update3->bind_param('sss', $newitemzone, $newitemsub, $ItemID);

//execute all statements
  $status1 = $update1->execute();
  $status2 = $update2->execute();
  $status3 = $update3->execute();

//check for errors in SQL connection
  if ($status1 === false) {
    trigger_error($update1->error, E_USER_ERROR);
  } elseif ($status2 === false) {
    trigger_error($update2->error, E_USER_ERROR);
  } elseif ($status3 === false) {
    trigger_error($update3->eroor, E_USER_ERROR);
  } else{
//echo out concat.
  phpAlert("Item successfully updated! ItemID: " . $ItemID . " Item Name: ". $newitemname. " Item QTY: ". $newitemQTY. " Item Location: " . $newitemzone. " " . $newitemsub);

//close out sql statements and the conneciton to the database
  $update1->close();
  $update2->close();
  $update3->close();
  $url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com';
  echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';
  }
$link->close();

?>
