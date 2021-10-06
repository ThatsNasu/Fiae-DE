<!DOCTYPE html>
<html lang="de">
<?php
	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) header("refresh:1200; url=/?autologout");
	$cookieOptions = array('expires' => time()+3600*24*30, 'path' => '/', 'domain' => '.dasnasu.bitbite.dev');
	if(!isset($_COOKIE['theme'])) setcookie('theme', 'light', $cookieOptions);
	
	//requirements
	require('./backend/databaselogin.php');
	require('./backend/dbmanager.php');
	require('./frames/navigation.php');


	//global objects
	$dbmanager = new DBManager($host, $database, $login, $pass);

	//page requirements
	$navigation = new Navigation($dbmanager->getNavigationItems("navigation"));
	$footer = new Navigation($dbmanager->getNavigationItems("footernav"));



	//current
	require('./frames/head.php');
	?>
	<div class="profileMenu">
	<?php
	require('./frames/login.php');
	?>
		<div class="themeselector">
			<select name="themeselection" id="themeselection" onChange="themeselect();">
				<option value="default" <?php if(!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'default') { echo 'selected'; } ?>>Default Theme (Switch on Day/Night)</option>
				<option value="light" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') { echo 'selected'; } ?>>Light Theme</option>
				<option value="dark" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') { echo 'selected'; } ?>>Dark Theme</option>
			</select>
		</div>
	</div>
	<?php
	require('./frames/header.php');
	echo $navigation->getMainNavigation();
	require('./frames/content.php');
	echo $footer->getFooterNavigation();
?>