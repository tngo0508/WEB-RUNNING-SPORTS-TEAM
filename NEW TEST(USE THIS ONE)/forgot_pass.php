
<?php

session_start();
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("location: forget_passform.php");
  exit;
}
/// HERERERERERERERERERERERERERERERERERERERERERERERERERERE
// NEW EMAIL IF WE NEED SESSTION
  // creating short variable name
  $email =htmlspecialchars($_SESSION['email']);



  try {
    require_once 'random_password.php';
    $password = reset_password($email);
    require_once 'notify_password.php';
    notify_password($email, $password);
    echo 'Your new password has been emailed to you.<br>';
  }
  catch (Exception $e) {
    echo 'EMAIL COULDNT SENT.';
  }

?>
