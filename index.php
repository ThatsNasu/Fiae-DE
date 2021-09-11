<!DOCTYPE html>
<html lang="de">
<?php
	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) header("refresh:1200; url=./?autologout");
	if(!isset($_COOKIE['theme'])) setcookie('theme', 'light', time()+3600*24*30);
	
	//backend requirements
	require('./backend/databaselogin.php');
	require('./backend/dbmanager.php');


	//global objects
	$dbmanager = new DBManager($host, $database, $login, $pass);

	/*
		create missing tables and initialize it
		check user privileges and allow / deny access
		handle requests like exploding url on /, handle input parameters and such stuff
		generate content for page


		//content relevant stuff
		put descriptions next to the sublinks in schoolingmaterials
		filewalker for the ressources
		filedownlad
		fileupload with database update
		accesscontrol to files
		permission system
		previous visited for users who logged in


		//css stuff
		enable theming in a way that users cann choose which theme to use instead of relying on the time -> done, need to be revisited after user profile
		enable theming in a way that users can decide which themingcolor they want to use fpr accents and stuff like that
	*/

	//page requirements
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
	require('./frames/nav.php');
	require('./frames/content.php');
	require('./frames/footer.php');
?>