<!DOCTYPE html>
<html>
<?php
	//starts session
	session_start();
	//checks if Exist session variable is set
	if(isset($_SESSION["Exist"])){
		//javascript wrapped by php uses ajax to display the div
		echo " <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>

				<script>$( document ).ready(function() {
				//displays the div form 2
				$(\"#form2\").show();
				//animates form1 to slide up and form 2 to slide down by 300 px
				$(\"#form1\").slideUp();$(\"#form2\").animate({
				//increases height of form2
				height: '+300px',

			});}); </script>";

	}
	//checks if DoesntExist session vaiable is set
	if(isset($_SESSION["DoesntExist"])){
		//runs the javacript code
		echo "

			<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
			<script>
				//loads function on page load
				$( document ).ready(function()
				{
					//shows the hidden div
					$(\"#hides\").show();
					//changes the text of messages
					$(\"#messages\").text(\"Email Address is not valid!\");
				});
			</script>";

	}


?>
<head>
    <title>Forgotten Password</title>
	<link rel="stylesheet" href="Login.css" type="text/css" />
	<link rel="stylesheet" href="prof.css" type="text/css" />
<!--Ajax script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script >
//function
function Vpassword()
{
	//shows div message
	$("#message").show();
	//checks if the passwords on the form match
	if($('#verify_password').val() == $('#password').val() )
	{
		//prints they are matching and changes the color to green
		$('#message').html('Matching').css('color', 'green');
		//enables the submit button
		$('#submit-button').prop('disabled', false);
	}
	else
	{
		//prints they arnt matching and changes the text color to red
		$('#message').html('Passwords do not match').css('color', 'red');
		//disables the submit button
		$('#submit-button').prop('disabled', true);
	}
}

</script>

</head>

    <div class="wrapper">
		<div class="content">
			<!--Navigation bar-->
			<nav class="nav">
				<ul>
					<li><a href="Search.php">Home</a></li>
					<li><a href="Profile.php">Profile</a></li>
					<li><a href="NewRecipe.php">Upload</a></li>
					<li style="float:right"><a href="Login.php">Login</a></li>
				</ul>
			</nav>

			<!--Form for forgetting password-->
			<div  id="form1" class="form">
				<h1>Forgotten password</h1>
				<!--action page to recieve variables from post method -->
				<form action="changepw.php" method="post">
					<!--gets user input, pattern must contain lowercase letters followed by @ symbol followed by letters followed by .com only -->
					<input type="text" placeholder="Enter Email" name="email" pattern="[a-z]+@+[a-z]+.com" title="Must be a valid email" required>
					<!--hides a div class to display feedback to use when needed-->
					<div class="form" id="hides" style="display:none";><span id='messages'></span></div>
					<!--options for security quetions-->
					<select name="Security_Q"required>
						<!--disabled selection as its just there as a title really-->
						<option value="" disabled selected>Select your security question</option>
						<option value="Favourite animal" >Favourite animal</option>
						<option value="Mothers maiden name" >Mothers maiden name</option>
					</select>
					<!--answer to security q-->
					<input type="text" placeholder="Security answer"   name="Security_A" required>
					<!--submit button-->
					<input type="submit" value="Verify">
				</form>
			</div>

			<!--Form for changing password-->
			<div id="form2" class="form" style="display:none">
				<!--header-->
				<h1>Change password</h1>
				<!--action pages is updated.php-->
				<form action="updatepw.php" method="post">
					<!--imput type is password, sets the minimum length as 6 so the users pw has to have 6 or more characters-->
					<input type="password" placeholder="Enter Password" name="password" id="password" minlength="6" onkeyup="Vpassword()" required>
					<!--when the user types into this box it activated the function to verify the passwords match-->
					<input type="password" placeholder="Repeat Password" name="verify_password" id ="verify_password" onkeyup="Vpassword()" minlength="6"  required>
					<!--div is hidden for user feedback-->
					<div class="forgot" id="message" style="display:none"><span id='message'></span></div>
					<input type="submit" value="Change Password"style="float:bottom">
				</form>
			</div>
		</div>
	</body>

</html>
