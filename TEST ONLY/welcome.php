



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
	<head>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FOR WEBSITE CSUF BASKETBALL TEAM">
	  <meta name="keywords" content="web design">
  	<meta name="author" content="TEAM CPSC431">
    <title>BASKETBALL TEAM MANAGEMENT | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
	</head>

	<body>
		<header>
			<div class= "container">
				<div id= "top">
          <img src="./logo/1.jpg" alt="CSUF LOGO" height="100" width="100" />
					<h1> BASKETBALL TEAM MANAGEMENT </h1>
				</div>
				<nav>
					<ul>
						<li><a href="welcome.php">Home</a></li>
						<li><a href="https://catalog.fullerton.edu/content.php?catoid=1&navoid=93">About</a></li>
            <li><a href="services.html">Services</a></li>
					</ul>
				</nav>
				</div>
			</header>
			<section id = "logining">
				<div class= "flex-containter">
					<div class="leftpane">
					<h1>Login form</h1>
					<?php require_once('login.php') ?>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
								<label>Username:<sup>*</sup></label>
								<input type="text" name="username"class="form-control">
								<span class="help-block"><?php echo $username_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
								<label>Password:<sup>*</sup></label>
								<input type="password" name="password" class="form-control">
								<span class="help-block"><?php echo $password_err; ?></span>
						</div>

						<div class="form-group">
								<input type="submit" class="btn btn-primary" value="Submit">
						</div>
						<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
					</form>
				</div>
        <div class="rightpane">
        <h1>INTRODUCTION</h1>
        <p>From humble beginnings and with modest resources,
					the Cal State Fullerton Titans have achieved successes
					 that are the envy of many older and larger universities across the country.
					  The Titans have won 12 national team championships
						in seven different sports and have produced hundreds
						of individual All-Americans, dozens of professional athletes,
						 several Olympians, and numerous national coach of the year award winners.
						  A National Collegiate Athletic Association Division I-AAA institution,
							 Cal State Fullerton competes in the Big West Conference.
					The competitive profile and geographic expansion.
				</p>
        </div>
      </div>
	</div>
</section>
<section id = "boxes">
	<img src="./logo/3.jpg" />
</section>
<footer>
<p> Author by CPSC 431 TEAM, copyright &copy; 2018 </p>
</footer>

</body>
</html>
