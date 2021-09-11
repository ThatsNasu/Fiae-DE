<nav>
    <?php
        $entries = $dbmanager->getMainMenuItems();
        for($i = 0; $i < sizeof($entries); $i++) {
            if($entries[$i]['requiresLogin'] == 0) {
                echo '<div class="mainMenuButton"><a href="'.$entries[$i]['target'].'">'.$entries[$i]['value'].'</a>';
                $childs = $dbmanager->getChildItems($entries[$i]['id']);
                if(sizeof($childs) != 0) {
                    echo '<div>';
                    for($j = 0; $j < sizeof($childs); $j++) {
                        echo '<div class="childMenuItem"><a href="'.$childs[$j]['target'].'">'.$childs[$j]['value'].'</a></div>';
                    }
                    echo '</div>';
                }
                echo '</div>';
            } else {
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    echo '<div class="mainMenuButton"><a href="'.$entries[$i]['target'].'">'.$entries[$i]['value'].'</a>';
                    $childs = $dbmanager->getChildItems($entries[$i]['id']);
                    if(sizeof($childs) != 0) {
                        echo '<div>';
                        for($j = 0; $j < sizeof($childs); $j++) {
                            echo '<div class="childMenuItem"><a href="'.$childs[$j]['target'].'">'.$childs[$j]['value'].'</a></div>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
        }
    ?>
</nav>