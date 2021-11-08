<?php
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
		echo 'Willkommen '.$_SESSION['user'].' <a href="../?logout">Logout</a>';
	} else {
		?>
			<div class="login_required">
				<div class="headline">
					Sorry but...
				</div>
				...it is absolutely needed that you are logged in to view this page. If you don't have a login or don't know where to find it, reach out to DasNasu or AuroraIceStorm on the FIAE Discord.
				If it should be the case that you found this page by accident, i have to tell you that this is a private website, not to meant viewed by the public, sorry. 
				<div class="login">
					<form method="post">
						<input type="text" name="user" placeholder="Login" />
						<input type="password" name="pass" placeholder="Password" />
						<input type="submit" value="Login" />
					</form>
				</div>
			</div>
		<?php
	}
	if(isset($_POST['user']) && isset($_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
		$data = $dbmanager->getLogin($_POST['user']);
		if($data['pass'] === hash('sha256', $_POST['pass']) && $data['active'] == 1) {
			$_SESSION['user'] = $_POST['user'];
			if(isset($_GET) && isset($_GET['url']) && $_GET['url'] != "Logout" && $_GET['url'] != "Loginerror") echo '<meta http-equiv="refresh" content="0; URL='.$_SERVER['HTTP_REFERER'].'">';
			else echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/User/'.$_SESSION['user'].'">';
		} elseif(!$data) {
			echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Loginerror?c=notcreated">';
		} else {
			echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Loginerror?c=misstype">';
		}
	} elseif(isset($_GET['autologout'])) {
		session_destroy();
		echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Logout?c=auto">';
	} elseif(isset($_GET['logout'])) {
		session_destroy();
		echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Logout">';
	}
?>
