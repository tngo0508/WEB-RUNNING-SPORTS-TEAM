<?php
// Include config file
require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values
$email ="";
$password ="";
$confirm_password="";

$email_err = $password_err = $confirm_password_err = $type_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  // checking email if valid or not
  
  if(empty(trim($_POST["email"]))){
      $email_err = "Please enter a email.";
  } else{
      // Prepare a select statement
      $sql = "SELECT USERS.USER_ID FROM USERS WHERE USERS.EMAIL = ?";

      $stmt=$link->prepare($sql);
      $stmt ->bind_param('s', $email_check);
      $email_check = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
      if($stmt->execute()){
          /* store result */
          $stmt->store_result();
          if($stmt->num_rows() == 1){
              $email_err = "This name already taken.";
          } else{
              $email = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
          }
      } else{
          echo "Please try again later.";
      }
      $stmt->close();

  }

  // checking password
  if(empty(trim($_POST['password']))){
      $password_err = "Please enter a password.";
  } elseif(strlen(trim($_POST['password'])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
    $password = trim( preg_replace("/\t|\R/",' ',$_POST['password']) );
  }

  // Validate confirm password
  $password = trim( preg_replace("/\t|\R/",' ',$_POST['password']) );
  $confirm_password=trim( preg_replace("/\t|\R/",' ',$_POST['confirm_password']) );

  if(empty(trim($_POST["confirm_password"]))){
      $confirm_password_err = 'Please confirm password.';
  } else{
      $confirm_password = trim($_POST['confirm_password']);
      if($password != $confirm_password){
          $confirm_password_err = 'Password did not match.';
      }
  }

    // Check input errors before inserting in database
if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO USERS SET
                  USERS.EMAIL = ?,
                  USERS.PASSWORD_HASH= ?
                  ";

        $stmt=$link->prepare($sql);
        $stmt->bind_param('ss',
        $email,
        $password = password_hash($password, PASSWORD_DEFAULT)
      );
        // Attempt to execute the prepared statement
      if($stmt->execute()){
                // Redirect to login page
          header("location: welcome.php");
          exit;
      }
      else{
          echo "Something went wrong. Please try again later.";
          }
          $stmt->close();

      }



    // Close connection
    $link->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{
          font: 14px sans-serif;
         }
        .wrapper{
          width: 350px;
          padding: 20px;
          background-color:lightblue;

        }
    </style>

</head>
<body>
    <div class="wrapper" >
        <h2>Sign Up As </h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>EMAIL:<sup>*</sup></label>
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div>


            </div>
         	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password:<sup>*</sup></label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password:<sup>*</sup></label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="welcome.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
