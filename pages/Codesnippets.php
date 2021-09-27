<?php
    $splits = explode('/', $_GET['url']);
    $pagehead = $splits[sizeof($splits)-1];
    
?>
<div class="headline">
    <?php
        echo $pagehead;
    ?>
</div>
<?php
    function checkChild($haystack, $needle) {
        foreach($haystack as $menuItem) {
            if($menuItem->getValue() == $needle) {
                if(sizeof($menuItem->getChildren()) != 0) {
                    echo '<div class="subcategories">';
                    foreach($menuItem->getChildren() as $child) {
                        echo '<div class="subcategory"><a href="'.$child->getTarget().'">'.$child->getValue().'</a></div>';
                    }
                    echo '</div>';
                }
            } else {
                checkChild($menuItem->getChildren(), $needle);
            }
        }
    }

    checkChild($navigation->getMainMenuItems(), $pagehead);
    if(sizeof($splits) != 1) {
        echo '<article>';
        if(file_exists('./pages/codesnippets/'.$pagehead.'.php')) {
            require('./pages/codesnippets/'.$pagehead.'.php');
        } elseif(file_exists('./pages/codesnippets/'.$pagehead.'.html')) {
            require('./pages/codesnippets/'.$pagehead.'.html');
        }
        echo '</article>';
    }
?>