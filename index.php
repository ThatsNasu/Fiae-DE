<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) header("refresh:1200; url=./?autologout");
	
	//backend requirements
	require('./backend/databaselogin.php');
	require('./backend/dbmanager.php');


	//global objects
	$dbmanager = new DBManager($host, $database, $login, $pass);

	/*
		auto logout (i know it works, i just need to find my code)
		connect to database
		create missing tables and initialize it
		check user privileges and allow / deny access
		handle requests like exploding url on /, handle input parameters and such stuff
		generate content for page
	*/

	//page requirements
	require('./frames/head.php');
	require('./frames/login.php');
	require('./frames/header.php');
	require('./frames/nav.php');
	require('./frames/content.php');
	require('./frames/footer.php');
?>