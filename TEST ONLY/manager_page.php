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
     $choice = $choice_err= "";
     require_once 'config.php';
     $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

     // Check connection
     if($link === false){
         die("ERROR: Could not connect. " . mysqli_connect_error());
     }
     if($_SERVER["REQUEST_METHOD"] == "POST"){

       // checking username if valid or not

       if(empty(trim($_POST["choice"]))){
           $choice_err = 'You need to select one !!!';
       } else{
           $choice = trim( preg_replace("/\t|\R/",' ',$_POST['choice']) );
       }


  }

?>

<body>
  <h1>Hi, <b><?php
  echo $_SESSION['email'];
   ?></b>. Welcome
  <a href="logout.php" >Sign Out</a> ||
  <a href="update_profile.php">Profile</a></h1>

  <div class="flex-containers">
    <div style="flex-grow: 1">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group <?php echo (!empty($choice_err)) ? 'has-error' : ''; ?>">
            <label>Your Position:</label>
            <select name="choice" class="form-control" value="<?php echo $choice; ?>">
              <option value="E">edit </option>
              <option value="P">Player</option>
              <option value="" selected>Your choice here</option>
            </select>
            <span class="help-block"><?php echo $choice_err; ?></span>
          </div>
          <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </from>
    <?php

    if($choice == 'E'){
      echo "edit line up ";
    }
    else if ($choice == 'P'){
      echo " adding player sql ";
    }
    ?>
    </div>
    <div style="flex-grow: 1">

      <p> Your Next Match || Schedule </p>


    </div>
  </div>

</body>

  <?php
  require "footer.php";
  ?>
