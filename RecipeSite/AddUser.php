<?php
	//Function to print javascript alert window script
	function alert($msg) {
		echo '<script type="text/javascript">
		alert("' . $msg . '");
		</script>'; //Creates alert window with passed message
	}

	$db = mysqli_connect("localhost", "root", "", "RecipeDB");

	if(!$db){
		echo 'NOT CONNECTED';
	}

	if(!mysqli_select_db($db,'RecipeDB')) {
		echo 'DATABASE NOT SELECTED';
	}

	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$pass = mysqli_real_escape_string($db, $_POST['pass']);
	$pass2 = mysqli_real_escape_string($db, $_POST['confpass']);
	$bio = mysqli_real_escape_string($db, $_POST['pass']);
	$Security_Q= mysqli_real_escape_string($db, $_POST['Security_Q']);
	$Security_A = mysqli_real_escape_string($db, $_POST['Security_A']);

	if(isset($_FILES['pic'])) {
		$file = $_FILES['pic'];

		if($file['error'] === 0){
			$fileName = uniqid('', true) . $file['name'];
			$fileDest = 'Images/' . $fileName;

			if(move_uploaded_file($file['tmp_name'],$fileDest)){

			}
		}
		else{
			alert("File not uploaded. Error code: {$file['error']}");
			$fileName = 'profile-pic.png';
		}
	}
	else{
		$fileName = 'profile-pic.png';
	}

	if($pass == $pass2){

		$hashpass = hash('sha512', $pass);

		$sql = "INSERT INTO USERS(Username,Email,Password,User_Desc,User_Img,Security_Q,Security_A)
		VALUES('$username', '$email', '$hashpass','$bio','$fileName','$Security_Q','$Security_A')";

			if(!mysqli_query($db, $sql)){
				alert("Not Inserted");
			}
	}
	else {
		alert("Passwords do not match");
	}

	header("refresh:0; url = login.php");

?>
