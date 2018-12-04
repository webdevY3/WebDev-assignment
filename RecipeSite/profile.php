<?php
//FUNCTIONS---------------------------------------------------------------------
	//Funtion to connect to the database, not complex but is called alot
	function connect(){
		$db = mysqli_connect("localhost", "root", "", "RecipeDB"); //Connect to database
		if(!$db){ //Error checking
		  echo 'NOT CONNECTED';
		}
		if(!mysqli_select_db($db,'RecipeDB')) { //Error checking
		  echo 'DATABASE NOT SELECTED';
		}
		return $db;
	}

	//Function to query database
	function query($sql){
		$db = connect();
		$result = mysqli_query($db, $sql); //Database queried with sql statement, data returned to result variable
		return $result;
	}
	//Function to return all sql data for that user
	function getUser($UserID){
		$db = connect();
		$result = query("SELECT * from USERS WHERE User_ID = '$UserID'");
		//Queryfunction, taking user ID from function function call , data returned to result variable
		if (mysqli_num_rows($result) >0) { //Error checking, if there is no result for the query
	    $row = mysqli_fetch_assoc($result);
			return $row; //Return row if good
		}
		else {
	    echo "Error, unexpected number of rows returned Users"; //Alerting user of error, no sql result returned
		}
	}

	//Function to calculate the a users average Rating based on all their ratings
	function getRating($UserID){
		$db = connect(); //Connects to and returns database
		$sql = "SELECT * from RATINGS WHERE Rated_ID = '$UserID'"; //Sql query grabs all ratings for a certain user
		$result = mysqli_query($db, $sql); //Database queried with sql statement, data returned to result variable

		if (mysqli_num_rows($result) >0) { //Error checking, if there is no result for the query
			$rating = 0; //Init rating variable
			for ($x = 0; $x < mysqli_num_rows($result); $x++) { //Loop for ever row that was returned
				$row = mysqli_fetch_assoc($result); //Grab the next row
				$rating = $rating + $row['Rating']; //Add rating number to total
			}
			$rating = $rating/mysqli_num_rows($result); //Divide total ratings by number of rating to get average
			return $rating; //Return average
		}
		else {
			echo "NA"; //Alerting user of error, no sql result returned
		}

	}

	//Function to print javascript alert window script
	function Alert($msg) {
    echo '<script type="text/javascript">
		alert("' . $msg . '");
		window.location.href="login.php";
		</script>'; //Creates alert window with passed message and redirects to login page
  }
//MAIN SCRIPT-------------------------------------------------------------------
	session_start(); //Starts session, important for login
	$db = connect(); //Connects to and returns database

	if (!isset($_GET['UserID'])){ //Checks if a user is referenced in url
		if (isset($_SESSION['SID'])){ //Checks if a user is signed in
			$UserID = $_SESSION['SID']; //If signed in then assigns value to UsedID
		}
		else{
			alert("You are not logged in"); //Alerts user to sign in, no url reference and not signed it
		}
	}
	else{
		$UserID = $_GET['UserID']; // Only case left is user referenced by url, nesting above is important
	}
	//UserID is used in a lot of calls later
?>

<html>
<head>
  <title>ProfilePage</title>
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
<!--PROFILE START___________________________________________________________ -->
      <div class="profInfo">
        <div class="gridCont"> <!--Using css grids for easier placement -->

          <div class="gridPic">
            <img src="Images/<?php echo getUser($UserID)['User_Img']; ?>" height="100"> <!--Calls the get user function and then echos the users img -->
          </div>

          <div class="gridUser">
						<?php echo getUser($UserID)['Username']; ?> <!--Calls the get user function and then echos the users Name -->
          </div>

          <div class="gridDesc" contenteditable="false"> <!--EditFunction() will change contenteditable later -->
            <?php echo getUser($UserID)['User_Desc']; ?> <!--Calls the get user function and then echos the users Description -->
          </div>

          <div class="gridRating">
            Rating: <?php echo getRating($UserID); ?>/5 <!--Calls the average rating function and then echos the users rating -->
          </div>

					<div class="gridEdit">
						<button id="editbutton" type="button" onclick="editFunction()">Edit Profile</button> <!--This doesnt do anything yet -->
					</div>

        </div>
      </div>
<!--RECIPES START___________________________________________________________ -->
      <div class="profInfo">
				<h2>Recipes</h2>
        <hr>
        <?php
				$result = query("SELECT * FROM recipes WHERE User_ID = '$UserID'"); //Sql query grabs all recipes for a certain user
				if (mysqli_num_rows($result) >0) { //Error checking, make sure user hasat least one recipe
					for ($x = 0; $x < mysqli_num_rows($result); $x++) {//For every row returned
						$row = mysqli_fetch_assoc($result); //Grab next row
		    		echo'
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
						</div>'; //Echo recipe info from that row with some html formating
					}
				}
				else {
					echo "This user has no Recipes"; //Echo if there are no results recipes
				}
				?>
			</div>
	<!--RATINGS START_________________________________________________________ -->
      <div class="profInfo">
        <h2>Ratings</h2>
        <hr>
				<?php
				$result = query("SELECT * FROM ratings WHERE Rated_ID = '$UserID'"); //Sql query grabs all ratings for a certain user
				if (mysqli_num_rows($result) >0) { //Error checking, make sure user has at least one rating
					for ($x = 0; $x < mysqli_num_rows($result); $x++) { //For every row returned
						$row = mysqli_fetch_assoc($result);  //Grab next row
		    		echo'
						<div class="RCont">
							<div class="RPic">
								<img src="Images/'.getUser($row['Reviewer_ID'])['User_Img'].'" height="70">
							</div>
							<div class="RateUser">
								<a href="profile.php?UserID='.getUser($row['Reviewer_ID'])['User_ID'].'">'.getUser($row['Reviewer_ID'])['Username'].'</a>
							</div>
							<div class="RateDesc">
								'.$row['Rating_Desc'].'
							</div>
							<div class="RateNum">
								'.$row['Rating'].'
							</div>
						</div>'; //Echo rating info from that row with some html formating
					}
				}
				else {
					echo "This user has no Ratings"; //Echo if there are no results ratings
				}
				?>
      </div>

    </div>
  </div>
</body>
</html>
