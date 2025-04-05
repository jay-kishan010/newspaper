<?php 
ob_start();
session_start();
date_default_timezone_set("Africa/Lagos");
$connection = new mysqli("localhost","root","","news") or die(mysqli_connect_error($connection));