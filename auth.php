<?php
require 'connection.php';
function phpAlert($msg) {
  echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
if ( !isset($_POST['username'], $_POST['password']) ){
  //Couldn't get the login data
  die('Please fill in both fields!');
}
if ($loginsql = $link->prepare('SELECT id, password FROM users WHERE username = ?')) {
  $loginsql->bind_param('s', $_POST['username']);
  $loginsql->execute();
  $loginsql->store_result();
}
if ($loginsql->num_rows > 0) {
  $loginsql->bind_result($id, $password);
  $loginsql->fetch();
  //Acct exists, now we have to verify
  if ($_POST['password'] === $password) {
    //Verfies, now we need to make sessions to know if the user is logged in
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['id'] = $id;
    header('Location: login_landing.php');
  } else {
      phpAlert("Incorrect password! Please try again.");
      $url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com/login.html';
      echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

  }
} else {
    phpAlert("Incorrect username! Please try again.");
    $url = 'http://ec2-18-225-33-105.us-east-2.compute.amazonaws.com/login.html';
    echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

}
$loginsql->close();
?>
