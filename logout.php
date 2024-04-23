<?php
	include 'includes/session.php';
	logout();
	header('Location: home.php'); 
	print "<script>window.location = 'home.php'</script>";
?>

