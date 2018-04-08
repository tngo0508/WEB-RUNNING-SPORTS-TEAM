<?php

$username = $password ="";
$id = "";
$username_err = $password_err = "";

if( empty($username) ) $username = null;
if( empty($password)  ) $password  = null;

if($_SERVER["REQUEST_METHOD"]== "POST"){
  if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['username'])))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim(preg_replace("/\t|\R/",' ',$_POST['password'])))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
  require_once 'config.php';
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }

// users check
if ( empty($username)){
    $username_err= 'Please enter your username here.';
}else {
    $username = $username;
}

// password check

if ( empty($password)){
    $password_err= 'Please enter your username here.';
}else {
    $password = $password;
}
// check validate credentials

if(empty($username_err) &&empty($password_err) ){

    $query= " SELECT
              MANAGER.ID,
              MANAGER.Username,
              MANAGER.Password

              FROM MANAGER
              WHERE MANAGER.Username = ?";
    $stmt = $link->prepare($query);
    $stmt-> bind_param("s", $username_check);
    $username_check = $username;
    if($stmt->execute()){
    $stmt->store_result();
    $stmt->bind_result($id,
                      $username,
                      $hashed_password);

      while($stmt->fetch()==1){

          
        if(password_verify($password,$hashed_password)){
                  session_start();
                  $_SESSION['username'] = $username;
                 $_SESSION['id'] = $id;

                  header("location: manager_page.php");
                }
                else{
                  $password_err = "\n The password Incorrect ):";
                }
              }
    }

    else
    {
      echo "something wrong with the query!!!!";
    }


}
}
?>
