<?php
    $pagehead = "Ressourcen";
    if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        ?>
            <article>
                <div class="headline">Sorry, aber...</div>
                ... dies ist ein Bereich, der ohne g&uuml;ltigen Login nicht betreten werden darf. In 5 Sekunden leite ich dich wieder zur&uuml;ck auf die Homepage.
            </article>
        <?php
        header("refresh:5; url=../");
        return;
    } else {
        ?>
        <div class="headline">
            <?php
                echo $pagehead;
            ?>
        </div>
        <div class="subcategories">
            <?php
                foreach($navigation->getMainMenuItems() as $menuItem) {
                    if($menuItem->getValue() == $pagehead) {
                        foreach($menuItem->getChildren() as $child) {
                            echo '<div class="subcategory"><a href="'.$child->getTarget().'">'.$child->getValue().'</a></div>';
                        }
                    }
                }
            ?>
        </div>
        <?php
    }
?>