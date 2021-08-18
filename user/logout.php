<?php 
	include('_akses.php');
	session_destroy();
	$login_page = "../";
  	if ($login_page) {
    	header("Location: $login_page");
    	exit;
  	}
