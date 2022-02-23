<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    $result = array();
    if(isset($_POST['olduser']) && isset($_POST['newuser']) && isset($_POST['newuserconfirm'])) {
        $result[0] = 'usr';
        if($_POST['newuser'] !== $_POST['newuserconfirm']) $result[1] = 'Error: New Username does not match';
        elseif($dbman->updateUser($_SESSION['user']->getUUID(), 'username', $_POST['newuser'])) $result[1] =  'Successfully changed';
    }
    if(isset($_POST['oldfull']) && isset($_POST['newfull']) && isset($_POST['newfullconfirm'])) {
        $result[0] = 'full';
        if($_POST['newfull'] !== $_POST['newfullconfirm']) $result[1] = 'Error: New Fullname does not match';
        elseif($dbman->updateUser($_SESSION['user']->getUUID(), 'fullname', $_POST['newfull'])) $result[1] =  'Successfully changed';
    }
    if(isset($_POST['oldnick']) && isset($_POST['newnick']) && isset($_POST['newnickconfirm'])) {
        $result[0] = 'nick';
        if($_POST['newnick'] !== $_POST['newnickconfirm']) $result[1] = 'Error: New Nickname does not match';
        elseif($dbman->updateUser($_SESSION['user']->getUUID(), 'nickname', $_POST['newnick'])) $result[1] =  'Successfully changed';
    }
    if(isset($_POST['oldmail']) && isset($_POST['newmail']) && isset($_POST['newmailconfirm'])) {
        $result[0] = 'mail';
        if($_POST['newmail'] !== $_POST['newmailconfirm']) $result[1] = 'Error: New Email does not match';
        elseif($dbman->updateUser($_SESSION['user']->getUUID(), 'email', $_POST['newmail'])) $result[1] =  'Successfully changed';
    }
    if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['newpasswordconfirm'])) {
        $result[0] = 'passwd';
        if(password_verify($_POST['oldpassword'], $_SESSION['user']->getPassword())) {
            if($_POST['newpassword'] !== $_POST['newpasswordconfirm']) $result[1] = 'error: passwords do not match';
            elseif($dbman->updateUser($_SESSION['user']->getUUID(), 'password', password_hash($_POST['newpassword'], PASSWORD_DEFAULT))) $result[1] =  'Successfully changed';
        }
    }
?>
<section>
    <article>
        Change username:
        <form method="post">
            <input type="text" name="olduser" placeholder="Old Username" required />
            <input type="text" name="newuser" placeholder="New Username" required />
            <input type="text" name="newuserconfirm" placeholder="Confirm New Username" required />
            <input type="submit" value="Change it" />
        </form>
        <?php if(isset($result[0]) && $result[0] == 'usr') echo $result[1]; ?>
    </article>
    <article>
        Change password:
        <form method="post">
            <input type="password" name="oldpassword" placeholder="Old Password" required autocomplete="new-password" />
            <input type="password" name="newpassword" placeholder="New Password" required autocomplete="new-password" />
            <input type="password" name="newpasswordconfirm" placeholder="Confirm New Password" required autocomplete="new-password" />
            <input type="submit" value="Change it" />
        </form>
        <?php if(isset($result[0]) && $result[0] == 'passwd') echo $result[1]; ?>
    </article>
    <article>
        Change emailadress (leave new email blank to delete the record):
        <form method="post">
            <input type="email" name="oldmail" placeholder="Old Email" required />
            <input type="email" name="newmail" placeholder="New Email" />
            <input type="email" name="newmailconfirm" placeholder="Confirm New Email" />
            <input type="submit" value="Change it" />
        </form>
        <?php if(isset($result[0]) && $result[0] == 'mail') echo $result[1]; ?>
    </article>
    <article>
        Change fullname (leave new fullname blank to delete the record):
        <form method="post">
            <input type="text" name="oldfull" placeholder="Old Fullname" required />
            <input type="text" name="newfull" placeholder="New Fullname" />
            <input type="text" name="newfullconfirm" placeholder="Confirm New Fullname" />
            <input type="submit" value="Change it" />
        </form>
        <?php if(isset($result[0]) && $result[0] == 'full') echo $result[1]; ?>
    </article>
    <article>
        Change nickname (leave new nickname blank to delete the record):
        <form method="post">
            <input type="text" name="oldnick" placeholder="Old Nickname" required />
            <input type="text" name="newnick" placeholder="New Nickname" />
            <input type="text" name="newnickconfirm" placeholder="Confirm New Nickname" />
            <input type="submit" value="Change it" />
        </form>
        <?php if(isset($result[0]) && $result[0] == 'nick') echo $result[1]; ?>
    </article>
</section>