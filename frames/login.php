<div class="loginarea">
	<?php
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			echo 'Willkommen '.$_SESSION['user'].' <a href="./?logout">Logout</a>';
		} else {
			?>
				<form action="./" method="POST">
					<input type="text" placeholder="Username" required name="user">
					<input type="password" placeholder="Password" required name="pass">
					<input type="submit" value="Login">
				</form>
			<?php
		}
		if(isset($_POST['user']) && isset($_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])) {
			$data = $dbmanager->getLogin($_POST['user']);
			if($data['pass'] === hash('sha256', $_POST['pass']) && $data['active'] == 1) {
				$_SESSION['user'] = $_POST['user'];
				echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Controlpanel">';
			} elseif(!$data) {
				echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Loginerror?c=notcreated">';
			} elseif($data['active'] != 1) {
				echo '<meta http-equiv="refresh" content="0; URL=https://dasnasu.bitbite.dev/Loginerror?c=inactive">';
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
</div>