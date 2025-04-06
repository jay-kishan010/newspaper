<?php 

session_start();

if (isset($_GET['logout'])) {
	unset($_SESSION['subscriber']);
	header("Location: index.php");
}




 ?>