<?php
  //Function to print javascript alert window script
  function Alert($msg) {
    echo '<script type="text/javascript">
    alert("' . $msg . '");
    window.location.href="login.php";
    </script>'; //Creates alert window with passed message and redirects to login page
  }

  session_start(); //Starts session, important for login
  if (!isset($_SESSION['SID'])){
    alert("You are not logged in");
  }
?>

<html>
<head>
    <title>New Recipe</title>
	<link rel="stylesheet" href="Login.css" type="text/css" />
  <link rel="stylesheet" href="prof.css" type="text/css" />
</head>
  <body>
    <div class="wrapper">
    <div class="content">

<!--NAV BAR_________________________________________________________________ -->
      <nav class="nav">
        <ul>
          <li><a href="Search.php">Home</a></li>
          <li><a href="Profile.php">Profile</a></li>
          <li><a href="NewRecipe.php">Upload</a></li>
          <li style="float:right"><a href="Login.php">Login</a></li>
        </ul>
      </nav>

<!--Form____________________________________________________________________ -->
      <div class="form">
        <h1>New Recipe</h1>
        <form action="NewRecipeScript.php" method="post" enctype="multipart/form-data">
          <input type="text" placeholder="Enter Recipe Name" name="RecipeName" required>
          <div class="PrepTime">Preperation time <small>(hrs:mins)</small>:
            <input type="time" placeholder="Enter Preperation Time" name="Prep" required>
          </div>
          <br>
          <div class="CookTime">Cook time <small>(hrs:mins)</small>:
            <input type="time" placeholder="Enter Cooking Time" name="Cook" required>
          </div>
          <textarea placeholder="Enter Ingredients" name="Ingredients"></textarea>
          <br>
          <textarea placeholder="Enter Directions" name="Directions"></textarea>
          <br>
          <div class="ImgSelect">Share a photo of your dish:</div>
          <input type="file" accept="image/*" name="pic">
          <input type="submit" value="Add Recipe">
        </form>
      </div>

    </div>
    </div>
  </body>
</html>
