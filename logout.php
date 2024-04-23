<?php
	//include 'includes/session.php';
	// logout();
	session_destroy();
	header('Location: home.php'); 
	print "<script>window.location = 'home.php'</script>";
?>

