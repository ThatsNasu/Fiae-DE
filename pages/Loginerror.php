<div class="headline">
    Sorry but...
</div>
<?php
    if(isset($_GET['c']) && !empty($_GET['c'])) {
        switch ($_GET['c']) {
            case 'misstype':
                echo '... you seem to have misstyped your login credentials, Go ahead and try again please.';
                break;
            case 'notcreated':
                echo '... your login seems not to exist in our database. Maybe try again later, our admin cannot be everywhere at once. If this error persists, feel free to reach out to our admin.';
                break;
            default:
                echo '... this is strange. You managed to break the page in a way that our webdev didn\'t even thought about. Whatever you did, think about it and maybe try a different approach.';
                break;
        }
    }
?>