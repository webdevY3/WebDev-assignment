<?php
	//FUNCTIONS----------------------------------------------------
	function Alert($msg) {
    echo '<script type="text/javascript">
    alert("' . $msg . '");
    </script>';
  }
	//start session
	session_start();
	//connect to database
	$db = mysqli_connect("localhost", "root", "", "RecipeDB");
	//retrieve form unsername
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);

	//hashing password to match databass hashed pw
	$hashpass = hash('sha512', $pass);
	//sql statement to retrieve user
	$sql = 'SELECT User_ID FROM users where Username ="'.$username.'" and password = "'.$hashpass.'"';
	//convert it to string and retrieve row
	$result = $db->query($sql);
	//if it returns a result
	if ($result->num_rows > 0)
	{
    // output data of each row
		while($row = $result->fetch_assoc())
		{
			//set session vaiable as user id
			$_SESSION['SID']=$row["User_ID"];
		}
	}




	//if user variable was set, user exits log them in
	if (isset($_SESSION['SID']))
	{
		alert("Logged in");
		header("refresh:0 ; url = profile.php?UserID=".$_SESSION['SID']);

	}
	//session variable wasnt set as no user found
	else
	{
		alert("Failed to log in. You are not a registered user, or your password/username is incorrect");
		header("refresh:0; url = login.php");
	}
	//close the
	$db->close();

?>
