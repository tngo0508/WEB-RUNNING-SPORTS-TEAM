<?php
     require "header.php";
     session_start();
     if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
?>

<body>
  <h1>Hi, <b><?php
  echo $_SESSION['email'];
   ?></b>. Welcome
  <a href="logout.php" >Sign Out</a> ||
  <a href="update_profile.php">Profile</a></h1>

  <div class="flex-containers">
    <div style="flex-grow: 1">1</div>
    <div style="flex-grow: 1">2</div>
  </div>
</body>

  <?php
  require "footer.php";
  ?>
