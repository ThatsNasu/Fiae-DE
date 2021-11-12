<!DOCTYPE html>
<html lang="de">
<?php
	session_start();
	// GLOBAL REQUIREMENTS
	require_once('./backend/databaselogin.php');
	require_once('./backend/dbmanager.php');
	require_once("./backend/scssAutoCompiler.php");

	// GLOBAL VARIABLES / OBJECTS
	$dbmanager = new DBManager($host, $database, $login, $pass);
	require_once('./frames/head.php');
	if(sizeof($_SESSION) === 0) {
		require('./frames/login.php');
	} else {
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])) header("refresh:1200; url=/?autologout");
		$cookieOptions = array('expires' => time()+3600*24*30, 'path' => '/', 'domain' => '.dasnasu.bitbite.dev');
		if(!isset($_COOKIE['theme'])) setcookie('theme', 'light', $cookieOptions);

		require_once('./frames/navigation.php');

		$navigation = new Navigation($dbmanager->getNavigationItems("navigation"));
		$footer = new Navigation($dbmanager->getNavigationItems("footernav"));

		echo '<div class="profileMenu">';
			require('./frames/login.php'); ?>
				<div class="themeselector">
					<select name="themeselection" id="themeselection" onChange="themeselect();">
						<option value="default" <?php if(!isset($_COOKIE['theme']) || $_COOKIE['theme'] == 'default') { echo 'selected'; } ?>>Default Theme (Switch on Day/Night)</option>
						<option value="light" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'light') { echo 'selected'; } ?>>Light Theme</option>
						<option value="dark" <?php if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') { echo 'selected'; } ?>>Dark Theme</option>
					</select>
				</div>
			</div><?php
		require_once('./frames/header.html');

		echo $navigation->getMainNavigation();
		require('./frames/linkage.html');
		require('./frames/content.php');
		echo $footer->getFooterNavigation();
	}
?>