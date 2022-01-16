<?php
    class Navigation {
        private $roots;

        private $tree;

        public function __construct($result) {
            $this->roots = array();
            foreach($result as $row) {
                if($row['parent'] == 0) array_push($this->roots, new MenuItem($row['id'], $row['parent'], $row['value'], $row['target'], $row['cssClass'], $row['inMainNavigation'], $row['inFooter'], $row['requiresLogin'], $result));
            }
            $this->createTree();
        }

        public function getRoots() {
            return $this->roots;
        }

        /*
            $loggedin specifies if a user is valid logged in;
            currently hardcoded defaulted to true for debugging and display purposes.
        */
        private function createTree($loggedin = true) {
            $this->tree = '<ul>';
            foreach($this->roots as $root) {
                if($loggedin && $root->requiresLogin()) {
                    $this->tree .= '<li><a href="'.$root->getTarget().'">'.$root->getValue().'</a>';
                    if($root->hasChildren()) {
                        $this->tree .= '<ul>';
                        $this->tree .= $root->showChildren($root->getTarget(), $loggedin);
                        $this->tree .= '</ul>';
                    }
                    $this->tree .= '</li>';
                } elseif(!$root->requiresLogin()) {
                    $this->tree .= '<li><a href="'.$root->getTarget().'">'.$root->getValue().'</a>';
                    if($root->hasChildren()) {
                        $this->tree .= '<ul>';
                        $this->tree .= $root->showChildren($root->getTarget(), $loggedin);
                        $this->tree .= '</ul>';
                    }
                    $this->tree .= '</li>';
                }
            }
            $this->tree .= '</ul>';
        }

        public function getTree() {
            return $this->tree;
        }
    }
?>