<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $user = new User($dbman->getUserData($_POST['username']));
        if(password_verify($_POST['password'], $user->getPassword())) {
            $_SESSION['user'] = $user;
            header("refresh:0");
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
    