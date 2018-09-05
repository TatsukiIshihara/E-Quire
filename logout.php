<?php
session_start();

if ($_SESSION["email_A"]=="") { 
	session_unset();
	session_destroy();

	header("location: user_login.php");

}else{
	session_unset();
	session_destroy();

	header("location: admin_login.php");

}
?>