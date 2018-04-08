<?php
// Include config file
require_once 'config.php';
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values
$username ="";
$password ="";
$confirm_password="";
$lastname="";
$firstname="";
$street ="";
$city="";
$state="";
$country="";
$zip="";


$street_err=$city_err=$state_err=$country_err=$zipcode_err=$username_err = $password_err = $confirm_password_err =$address_err= $phone_err=$fname_err=$lname_err=  "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $username= trim( preg_replace("/\t|\R/",' ',$_POST['username']) );
  $password = trim( preg_replace("/\t|\R/",' ',$_POST['password']) );
  $confirm_password=trim( preg_replace("/\t|\R/",' ',$_POST['confirm_password']) );
  $lastname= trim( preg_replace("/\t|\R/",' ',$_POST['lastname']) );
  $firstname= trim( preg_replace("/\t|\R/",' ',$_POST['firstname']) );
  $street =  trim( preg_replace("/\t|\R/",' ',$_POST['street']) );
  $city= trim( preg_replace("/\t|\R/",' ',$_POST['city']) );
  $state= trim( preg_replace("/\t|\R/",' ',$_POST['state']) );
  $country=trim( preg_replace("/\t|\R/",' ',$_POST['country']) );
  $zip=trim( preg_replace("/\t|\R/",' ',$_POST['zip']) );


    // Check input errors before inserting in database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($address_err)&&empty($phone_err) &&empty($name_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO MANAGER SET
                  MANAGER.Username=?,
                  MANAGER.Password=?,
                  MANAGER.Name_First=?,
                  MANAGER.Name_Last =?,
                  MANAGER.Street =?,
                  MANAGER.City =?,
                  MANAGER.State =?,
                  MANAGER.Country =?,
                  MANAGER.ZipCode =?";
        $stmt=$link->prepare($sql);
        $stmt->bind_param('ssssssssd',
        $username,
        $password = password_hash($Password, PASSWORD_DEFAULT),
        $firstname,
        $lastname,
        $street ,
        $city,
        $state,
        $country,
        $zipCode);
        // Attempt to execute the prepared statement
      if($stmt->execute()){
                // Redirect to login page
          header("location: welcome.html");
      }
      else{
          echo "Something went wrong. Please try again later.";
          }

      }
        // close statment query
        $stmt->close();



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
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
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

             <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>Your frist Name:<sup>*</sup></label>
                <input type="text" name="firstname"class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
               <label>Your last Name:<sup>*</sup></label>
               <input type="text" name="lastname"class="form-control" value="<?php echo $lastname; ?>">
               <span class="help-block"><?php echo $lname_err; ?></span>
           </div>
          <div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                <label>Street:<sup>*</sup></label>
                <input type="text" name="street"class="form-control" value="<?php echo $street; ?>">
                <span class="help-block"><?php echo $street_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>City:<sup>*</sup></label>
                <input type="text" name="city"class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
          </div>
          <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                  <label>State:<sup>*</sup></label>
                  <input type="text" name="state"class="form-control" value="<?php echo $state; ?>">
                  <span class="help-block"><?php echo $state_err; ?></span>
         </div>

          <div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
                <label>ZipCode:<sup>*</sup></label>
                <input type="text" name="zip"class="form-control" value="<?php echo $zip; ?>">
                <span class="help-block"><?php echo $zipcode_err; ?></span>
          </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>