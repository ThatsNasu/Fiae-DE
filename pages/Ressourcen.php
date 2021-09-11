<?php
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        ?>
            <div class="headline">
                Ressourcen
            </div>
            <div class="subcategories">
                <?php
                    $links = $dbmanager->getChildItems(2);
                    for($i = 0; $i < sizeof($links); $i++) {
                        echo '<div class="subcategory"><a href="'.$links[$i]['target'].'">'.$links[$i]['value'].'</a></div>';
                    }
                ?>
            </div>
        <?php
    } else {
        ?>
            <article>
                <div class="headline">Sorry, aber...</div>
                ... dies ist ein Bereich, der ohne g&uuml;ltigen Login nicht betreten werden darf. In 5 Sekunden leite ich dich wieder zur&uuml;ck auf die Homepage.
            </article>
        <?php
        header("refresh:5; url=../");
    }
?>

