<?php
	//Function to print javascript alert window script
	function alert($msg) {
		echo '<script type="text/javascript">
		alert("' . $msg . '");
		</script>'; //Creates alert window with passed message
	}

	session_start();
	$db = mysqli_connect("localhost", "root", "", "RecipeDB");

	if(!$db){
		echo 'NOT CONNECTED';
	}

	if(!mysqli_select_db($db,'RecipeDB')) {
		echo 'DATABASE NOT SELECTED';
	}

	$User = $_SESSION['SID'];
	$RecipeName = mysqli_real_escape_string($db, $_POST['RecipeName']);
	$Prep = mysqli_real_escape_string($db, $_POST['Prep']);
	$Cook = mysqli_real_escape_string($db, $_POST['Cook']);
	$Ingredients = mysqli_real_escape_string($db, $_POST['Ingredients']);
	$Directions = mysqli_real_escape_string($db, $_POST['Directions']);

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
		$fileName = 'cake_pic.png';
	}

	$sql = "INSERT INTO Recipes(User_ID,Recipe_Name,Prep_time,Cook_Time,Ingredients,Directions,Img)
	VALUES('$User','$RecipeName', '$Prep', '$Cook', '$Ingredients', '$Directions', '$fileName')";

		if(!mysqli_query($db, $sql)){
			alert("Recipe not added");
		}
		else{
			alert("Recipe added");
		}

	header("refresh:0; url = Profile.php");
?>
