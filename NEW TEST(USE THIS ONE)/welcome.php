<?php
     require "header.php";

?>

  <body>

    <div class="flex-containers">
      <div style="flex-grow: 5">
				<section id = "logining">
				<h1>Login form</h1>
			<?php require_once('login.php') ?>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
						<label>Email:<sup>*</sup></label>
						<input type="text" name="email"class="form-control">
						<span class="help-block"><?php echo $email_err; ?></span>
				</div>
				<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Pass:<sup>*</sup></label>
						<input type="password" name="password" class="form-control">
						<span class="help-block"><?php echo $password_err; ?></span>
				</div>

				<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit">
				</div>
				<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
         <a href="forgot_pass.php">FORGOT PASSWORD</a>.
			</form>
		</section>
		</div>
      <div style="flex-grow: 8"><img src="./logo/2.jpg" / height="600" width="1200"></div>
    </div>
  </body>


  <?php
  require "footer.php";
  ?>
