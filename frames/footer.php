<footer class="footer">
    <?php
        $footernav = $dbmanager->getFooterNav();
        for($i = 0; $i < sizeof($footernav); $i++) {
            if($footernav[$i]['requiresLogin'] == 0) {
                echo '<div><span>'.$footernav[$i]['value'].'</span>';
                $childs = $dbmanager->getFooterChilds($footernav[$i]['id']);
                if(sizeof($childs) != 0) {
                    for($j = 0; $j < sizeof($childs); $j++) {
                        echo '<a href="'.$childs[$j]['target'].'">'.$childs[$j]['value'].'</a>';
                    }
                }
                echo '</div>';
            } else {
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                    echo '<div><span>'.$footernav[$i]['value'].'</span>';
                    $childs = $dbmanager->getFooterChilds($footernav[$i]['id']);
                    if(sizeof($childs) != 0) {
                        for($j = 0; $j < sizeof($childs); $j++) {
                            echo '<a href="'.$childs[$j]['target'].'">'.$childs[$j]['value'].'</a>';
                        }
                    }
                    echo '</div>';
                }
            }
        }
    ?>
</footer>