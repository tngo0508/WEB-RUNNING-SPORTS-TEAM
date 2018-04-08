<?php
     require "header.php";
     session_start();
     if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
       header("location: welcome.php");
       exit;
     }
     if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
       header("location: welcome.php");
       exit;
     }
?>

  <body>
    <h1>Hi, <b><?php echo $_SESSION['username']; echo "|| Your ID: "; echo $_SESSION['id']; ?></b>. Welcome to Our Manager Page.</h1>
    <h1><a href="logout.php" class="btn btn-danger">Sign Out</a></h1>
    <section id = "manager">

    <div class= "flex-container">
      <div class="mleftpane">
      <h1>what do you want to do today?</h1>
      <p>HEREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        E</p>
    </div>
    <div class="mrightpane">
    <h1>Schedule Your Team</h1>
    <p>HEREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE  </p>
    </div>
  </div>

</section>
  </body>

  <?php
  require "footer.php";
  ?>
