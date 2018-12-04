<?php
	function alert($msg) {
		echo '<script type="text/javascript">
		alert("' . $msg . '");
		</script>'; //Creates alert window with passed message
	}
	//start session
	session_start();
	//set as php variable
	$email=$_SESSION["email"];
	//connect to database
	$db = mysqli_connect("localhost", "root", "", "RecipeDB");
	//check if its connected...
	if(!$db){
		echo 'NOT CONNECTED';
	}

	if(!mysqli_select_db($db,'RecipeDB')) {
		echo 'DATABASE NOT SELECTED';
	}

	//set password variable in php
	$password= mysqli_real_escape_string($db, $_POST['verify_password']);
	//hashing the pw to encrypt its
	$password=hash('sha512', $password);
	//update the users password where the email is theirs
	$sql = "UPDATE `users` SET `Password` = '$password' WHERE `email` = '$email';";
	//check if its updated correctly
	if($db->query($sql) === true){
		alert("Password changed successfully.");
	}
	else
	{ 	//check if its not updated
		echo "ERROR: Was not able to execute $sql. ". $mysqli->error;

	}
	//unset the session varibles so it can be used again
	session_destroy();
	//go to the login page for them to log in now

	header("refresh:0; url = login.php");


?>
