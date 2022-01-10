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

        private function createTree() {
            $this->tree = '<ul style="padding-left: 10px; list-style: none;">';
            
            foreach($this->roots as $root) {
                $this->tree .= '<li class="'.$root->getCSSClass().'"style style="padding-left: 10px; list-style: none;"><a href="'.$root->getTarget().'">'.$root->getValue().'</a>';
                if($root->hasChildren()) {
                    $this->tree .= '<ul style="padding-left: 10px; list-style: none;">';
                    $this->tree .= $root->showChildren($root->getTarget());
                    $this->tree .= '</ul>';
                }
                $this->tree .= '</li>';
            }
            $this->tree .= '</ul>';
        }

        public function getTree() {
            return $this->tree;
        }
    }
?>