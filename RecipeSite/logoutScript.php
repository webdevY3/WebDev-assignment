<?php
	//FUNCTIONS-------------------------------------------
	function Alert($msg) {
		echo '<script type="text/javascript">
		alert("' . $msg . '");
		</script>';
	}
	//start session
	session_start();
  //end session
  session_destroy();
  alert("You are logged out");
  header("refresh:0; url = login.php");
?>
