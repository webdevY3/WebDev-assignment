<?php
//MAIN SCRIPT-------------------------------------------------------------------
	session_start();
	$db = mysqli_connect("localhost", "root", "", "RecipeDB");
	if(!$db){
		echo 'NOT CONNECTED';
	}
	if(!mysqli_select_db($db,'RecipeDB')) {
		echo 'DATABASE NOT SELECTED';
	}

	if(isset($_POST['search'])){

	}

?>

<html>
<head>
  <title>Home</title>
	<link rel="stylesheet" href="prof.css" type="text/css" />
	<link rel="stylesheet" href="login.css" type="text/css" />
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
<!--SEARCH BAR______________________________________________________________ -->
			<div class="title">
				Search
			</div>
			<form method="post">
				<div class="search">
					<div class="searchbar"><input type="text" placeholder="e.g. Burgers" name="search"></div>
					<div class="searchbutton"><input type="submit" value="Search"></div>
				</div>
			</form>
<!--SEARCH RESULTS__________________________________________________________ -->
			<?php
				if(isset($_POST['search'])){
					$search = mysqli_real_escape_string($db, $_POST['search']);
					$sql = "SELECT * FROM recipes WHERE Description like '%{$search}%'";
					$result = mysqli_query($db, $sql);

					if (mysqli_num_rows($result) >0) {
						for ($x = 0; $x < mysqli_num_rows($result); $x++) {
							$row = mysqli_fetch_assoc($result);
							echo'
							<div class="profInfo">
								<div class="RCont">
									<div class="RPic">
										<img src="Images/'.$row['Img'].'" width="70" height="70">
									</div>
									<div class="RUser">
										<a href="recipe.php?RecID='.$row['Recipe_ID'].'">'.$row['Recipe_Name'].'</a>
									</div>
									<div class="RInfo">
										Serves: '.$row['Serves'].' people
									</div>
									<div class="RDesc">
										'.$row['Description'].'
									</div>
								</div>
							</div>';
						}
					}
					else {
						echo "Sorry, No results found!";
					}
				}
			?>

		</div>
  </div>
</body>
</html>
