<html>
<head>
    <title>Login</title>
	<link rel="stylesheet" href="Login.css" type="text/css" />
  <link rel="stylesheet" href="prof.css" type="text/css" />
</head>
  <body>
    <div class="wrapper">
    <div class="content">

      <nav class="nav">
        <ul>
          <li><a href="Search.php">Home</a></li>
          <li><a href="Profile.php">Profile</a></li>
          <li><a href="NewRecipe.php">Upload</a></li>
          <li style="float:right"><a href="Login.php">Login</a></li>
        </ul>
      </nav>

			<?php
				//start session
				session_start();

				if (isset($_SESSION['SID'])) //Check if the user is signed in
				{
					echo '
					<div class="form">
		        <h1>You are Logged in</h1>
		        <form action="logoutScript.php" method="post">
		          <input type="submit" value="Logout Here">
		        </form>
		      </div>'; //Display warning that they are already logged in and provide button to logout
				}
				else{
					echo '
					<div class="form">
		        <h1>Login</h1>
		        <form action="loginScript.php" method="post">
		          <input type="text" placeholder="Username" name="username">
		          <input type="password" placeholder="Password" name="pass">
		          <a href="register.html" class="forgot">Dont have an account? Register here</a>
              <a href="changepw1.php" class="forgot">Forgotten password?</a>
		          <input type="submit" value="Sign In">
		        </form>
		      </div>'; //User is not signed in and regular login page is displayed
				}

			?>
    </div>
    </div>
  </body>
</html>
