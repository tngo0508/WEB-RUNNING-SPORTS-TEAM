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
    <h1>Hi, <b><?php echo $_SESSION['email']; echo " || Your ID: "; echo $_SESSION['id']; ?></b>. Welcome to Our Normal User Page.</h1>
    <a href="logout.php" >Sign Out</a>
    <a href="update_profile.php">Update Profile</a>

    <div class = "manager">
          <div id = "flex-boxs">
                <li>What do you want to edit today?

                      <p> here is the information </p>








      </li>

      <li>Your Team Schedule</li>


    </div>




      </section>
  </body>

  <?php
  require "footer.php";
  ?>
