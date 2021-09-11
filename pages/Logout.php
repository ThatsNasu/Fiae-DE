<div class="headline">
    Logged out ...
</div>
<?php
    if(isset($_GET['c']) && !empty($_GET['c'])) {
        switch ($_GET['c']) {
            case 'auto':
                echo '... due to inactivity. We care about your safety, even it may seem to be inconvenient, but think about this: would you rather be automatically logged out, or have someone can do anything in your name?';
                break;
            default:
                break;
        }
    } else {
        echo '... because you told me to do so.';
    }
?>