<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    class Navigation {
        private $menuItems;

        public function __construct($result, $loggedin) {
            $list = array();
            foreach($result as $row) {
                if($loggedin >= $row['requiresLogin']) {
                    $menuItem = new MenuItem($row['id'], $row['parent'], $row['label'], $row['linksto'], $row['requiresLogin']);
                    if($row['inMainNavigation']) $menuItem->addNavigationPosition('inMainNavigation');
                    if($row['inFooter']) $menuItem->addNavigationPosition('inFooter');
                    array_push($list, $menuItem);
                }
            }
            $this->menuItems = $this->buildTree(0, $list);
        }

        private function buildTree($parentID, $menuItems) {
            $list = array();
            foreach($menuItems as $menuItem) {
                if($menuItem->getParent() == $parentID) {
                    $menuItem->setChildren($this->buildTree($menuItem->getID(), $menuItems));
                    array_push($list, $menuItem);
                }
            }
            return $list;
        }

        public function renderTree($navigationPosition) {
            $tree = '<ul>';
            foreach($this->menuItems as $root) {
                $tree .= $root->renderItem($navigationPosition);
            }
            $tree .= '</ul>';
            return $tree;
        }
    }
?>