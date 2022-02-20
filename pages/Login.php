<?php
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $user = new User($dbman->getUserData($_POST['username']));
        if(password_verify($_POST['password'], $user->getPassword())) {
            $_SESSION['user'] = $user;
            if($url[sizeof($url)-1] == 'Logout') {
                $urlbuilder = '';
                for($i = 0; $i < sizeof($url)-1; $i++) $urlbuilder .= '/'.$url[$i];
                header('Location: '.$urlbuilder);
            } else {
                header("refresh:0");
            }
        }
    }
    if(!Helpers::isLoggedIn()) {
        ?>
        <section>
            <article>
                <form method="post">
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input type="submit" value="Fire and forget" />
                </form>
            </article>
        </section>
        <?php
    }
?>
    