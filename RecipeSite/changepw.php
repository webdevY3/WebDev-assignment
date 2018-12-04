<?php
	//start session
	session_start();

	//connects to database
	$db = mysqli_connect("localhost", "root", "", "RecipeDB");
	//checks if its connected or not
	if(!$db){
		echo 'NOT CONNECTED';
	}

	if(!mysqli_select_db($db,'RecipeDB')) {
		echo 'DATABASE NOT SELECTED';
	}

	//sets php variables off the post submit form
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$Security_Q= mysqli_real_escape_string($db, $_POST['Security_Q']);
	$Security_A = mysqli_real_escape_string($db, $_POST['Security_A']);
	//prepared sql query, checks if email exists with these secutiry questions
	$sql = "select Email from  users where email= '$email' and Security_Q='$Security_Q' and Security_A='$Security_A'  ";
	//returns result
	$result = $db->query($sql);
	//checks if not working
	if(!mysqli_query($db, $sql)){
		echo "NOT working";
	}
	else{
		//if it retuns data set the session variable to show an email exists with these credentials
		if ($result->num_rows > 0) {
    // output data of each row
			while($row = $result->fetch_assoc()) {
			$_SESSION["Exist"] = "1";
			$_SESSION["email"] = $email;
			}
		}
		else
		{
			//if it doesnt exist set this session vaiable
			echo "Incorrect security question/email or answer";
			$_SESSION["DoesntExist"] = "1";
		}

	}
	//returns to the forgotten password page
	header("refresh:0; url = changepw1.php");
?>
