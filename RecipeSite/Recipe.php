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

  //Function to print javascript alert window script
	function Alert($msg) {
    echo '<script type="text/javascript">
		alert("' . $msg . '");
		</script>'; //Creates alert window with passed message
  }

//MAIN SCRIPT-------------------------------------------------------------------
  session_start(); //Starts session, important for login
  $db = connect(); //Connects to and returns database

  $RecID = $_GET['RecID'];
  $result =query("SELECT * FROM recipes WHERE Recipe_ID = '$RecID'");

  if (!mysqli_num_rows($result) === 1) { //if more than one result
    alert("Error, unexpected number of rows returned Users"); //Alert user of error
    header("refresh:0; url = Search.php");
  }
  else {
    $row = mysqli_fetch_assoc($result); // Only one result, grab the row
  }
?>

<html>
<head>
  <title>Recipe</title>
	<link rel="stylesheet" href="recipe.css" type="text/css" />
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
<!--RECIPE STARTS ___________________________________________________________-->
      <div class="profInfo">
        <div class="gridCont"> <!--Using css grids to make placement easier -->
          <div class="Ruser">
            <?php echo '<a href="profile.php?UserID='.$row['User_ID'].'">'.getUser($row['User_ID'])['Username'] .'</a>'; ?>
            <!--Echo the recipes user and link to their profile -->
          </div>

          <div class="RPic">
            <img src="Images/<?php echo $row['Img']?>" height="200"> <!--Echos the users profile pic -->
          </div>

          <div class="RInfo">
            <?php echo 'Preptime: '.$row['Prep_Time'].'<br>Cooktime: '.$row['Cook_Time'].'<br>Serves: '.$row['Serves'].'';?>
            <!--Echos the recipes preptime, cook time and serves -->
          </div>

          <div class="RName">
            <?php echo $row['Recipe_Name'];?> <!--Echos recipe name -->
          </div>

          <div class="RIng">
            <h2> Ingredients </h2>
            <hr>
            <?php echo $row['Ingredients'];?> <!--Echos recipe Ingredients, Unformatted and looks awful-->
          </div>

          <div class="RDir">
            <h2> Directions </h2>
            <hr>
            <?php echo $row['Directions'];?> <!--Echos recipe Directions, Unformatted and looks awful-->
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
