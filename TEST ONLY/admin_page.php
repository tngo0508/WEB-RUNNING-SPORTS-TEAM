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
    <h1>Hi, <b><?php echo $_SESSION['email']; echo " || Your ID: "; echo $_SESSION['id']; ?></b>. Welcome to Our ADMIN Page.</h1>
    <h1><a href="logout.php" class="btn btn-danger">Sign Out</a></h1>
    <h1><a href="update_profile.php" class="btn btn-danger">Update Profile</a></h1>

    <section id = "manager">
          <div class= "flex-boxs">
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
