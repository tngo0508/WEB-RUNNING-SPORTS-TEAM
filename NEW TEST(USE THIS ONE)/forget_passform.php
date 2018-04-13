<?php
  $email ="";
  $email_err="";
 if($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once 'config.php';
   $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

   // Check connection
   if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
   }
   if(empty(trim($_POST["email"]))){
       $email_err = "Please enter a email.";
   } else{
       $sql = "SELECT USERS.USER_ID FROM USERS WHERE USERS.EMAIL = ?";

       $stmt=$link->prepare($sql);
       $stmt ->bind_param('s', $email_check);
       $email_check = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
       if($stmt->execute()){
           /* store result */
           $stmt->store_result();
           if($stmt->num_rows() == 0){
               $email_err = "Your email is wrong( not in the database)";
           } else{
               $email = trim( preg_replace("/\t|\R/",' ',$_POST['email']) );
               try {
                 require_once 'random_password.php';
                 $password = reset_password($email);
                 require_once 'notify_password.php';
                 notify_password($email, $password);
                 echo 'Your new password has been emailed to you.<br>';
               }
               catch (Exception $e) {
                 echo 'Your password could not be reset - please try again later.';
               }
           }
       } else{
           echo "Please try again later.";
       }
       $stmt->close();

   }



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
        <h2>PLEASE INPUT YOUR EMAIL</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>EMAIL:<sup>*</sup></label>
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

        </form>
    </div>
</body>
</html>
